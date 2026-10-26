<?php

use CodeIgniter\Honeypot\Exceptions\HoneypotException;
use CodeIgniter\Security\Exceptions\SecurityException;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\TestResponse;

/**
 * Contact form: validation, CSRF, honeypot and the "nothing is sent or stored" demo behaviour.
 *
 * @internal
 */
final class ContactFormTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function tearDown(): void
    {
        unset($_COOKIE[config('Security')->cookieName]);
        parent::tearDown();
    }

    /** @return array<string, string> */
    private function valid(): array
    {
        return [
            'name'    => 'Sample Person',
            'email'   => 'sample@example.com',
            'subject' => '',
            'message' => 'This is a sample message for the demo.',
        ];
    }

    /** POSTs with a matching CSRF cookie and field so validation can be tested on its own. */
    private function postWithCsrf(array $data): TestResponse
    {
        $token                                    = csrf_hash();
        $_COOKIE[config('Security')->cookieName] = $token;

        return $this->post('contact', $data + [csrf_token() => $token]);
    }

    public function testFormPageHasFieldsCsrfTokenAndHoneypot(): void
    {
        $result = $this->get('contact');
        $result->assertStatus(200);
        $result->assertSee('Demonstration form');

        $body = $result->getBody();
        $this->assertMatchesRegularExpression('/<form[^>]+method="post"/', $body);

        foreach (['name="name"', 'type="email" id="email" name="email"', 'name="subject"', '<textarea', 'name="' . csrf_token() . '"', 'name="honeypot"'] as $needle) {
            $this->assertStringContainsString($needle, $body);
        }
    }

    public function testPostWithoutCsrfTokenIsRejected(): void
    {
        $this->expectException(SecurityException::class);

        $this->post('contact', $this->valid());
    }

    public function testValidSubmissionRedirectsToContactWithoutRenderingNotice(): void
    {
        $result = $this->postWithCsrf($this->valid());

        $result->assertStatus(303);
        $result->assertRedirectTo(base_url('contact'));
        $result->assertDontSee('This is a demonstration');
    }

    public function testFollowingGetShowsDemoNoticeOnceAndStoresNoFieldValues(): void
    {
        $values = $this->valid();
        $this->postWithCsrf($values)->assertStatus(303);

        // The session holds only the constant flash marker, never the submitted values.
        $this->assertTrue($_SESSION['contact_sent']);
        $this->assertStringNotContainsString($values['email'], json_encode($_SESSION));
        $this->assertStringNotContainsString($values['name'], json_encode($_SESSION));

        // Follow the redirect: the notice is shown, accessibly, with an empty form.
        $result = $this->withSession($_SESSION)->get('contact');
        $result->assertStatus(200);
        $result->assertSee('This is a demonstration');
        $result->assertSee('no email was sent and no information was stored');
        $result->assertDontSee('Please fix the following');
        $body = $result->getBody();
        $this->assertMatchesRegularExpression('/role="status"[^>]*data-focus-on-load/', $body);
        $result->assertDontSee($values['email']);
        $result->assertDontSee($values['name']);

        // Refreshing the GET repeats a plain GET: the one-time notice is gone and nothing is resubmitted.
        \Config\Services::resetSingle('session');
        $refresh = $this->withSession($_SESSION)->get('contact');
        $refresh->assertStatus(200);
        $refresh->assertDontSee('This is a demonstration');
        $refresh->assertDontSee('Thank you');
    }

    public function testEmptySubmissionShowsAccessibleErrors(): void
    {
        $result = $this->postWithCsrf(['name' => '', 'email' => '', 'subject' => '', 'message' => '']);

        $result->assertStatus(422);
        $result->assertSee('Please fix the following');
        $result->assertDontSee('This is a demonstration');

        $body = $result->getBody();
        $this->assertStringContainsString('role="alert"', $body);

        foreach (['name', 'email', 'message'] as $field) {
            $this->assertStringContainsString('id="' . $field . '-error"', $body);
            $this->assertMatchesRegularExpression('/id="' . $field . '"[^>]*aria-invalid="true"/s', $body);
            $this->assertStringContainsString('href="#' . $field . '"', $body); // summary links to the field
        }

        $this->assertStringNotContainsString('id="subject-error"', $body); // optional field
    }

    public function testInvalidEmailAndShortMessageAreRejected(): void
    {
        $result = $this->postWithCsrf(['name' => 'Ok Name', 'email' => 'not-an-email', 'subject' => '', 'message' => 'short']);
        $result->assertStatus(422);
        $body = $result->getBody();

        $this->assertStringContainsString('id="email-error"', $body);
        $this->assertStringContainsString('id="message-error"', $body);
        $this->assertStringNotContainsString('id="name-error"', $body);
    }

    public function testOverlongSubjectIsRejected(): void
    {
        $data            = $this->valid();
        $data['subject'] = str_repeat('a', 151);

        $result = $this->postWithCsrf($data);
        $result->assertStatus(422);

        $this->assertStringContainsString('id="subject-error"', $result->getBody());
    }

    public function testSubmittedValuesAreEscapedWhenRedisplayed(): void
    {
        $payload = '"><script>alert(1)</script>';
        $result  = $this->postWithCsrf(['name' => $payload, 'email' => 'bad', 'subject' => $payload, 'message' => $payload]);
        $result->assertStatus(422);
        $body = $result->getBody();

        $this->assertStringNotContainsString('<script>alert(1)</script>', $body);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $body);
    }

    public function testFilledHoneypotIsRejected(): void
    {
        $this->expectException(HoneypotException::class);

        $this->postWithCsrf($this->valid() + ['honeypot' => 'bot']);
    }

    public function testSubmittedDataIsNotWrittenToLogs(): void
    {
        $marker = 'zz-marker-' . bin2hex(random_bytes(4));
        $this->postWithCsrf(['name' => $marker, 'email' => $marker . '@example.com', 'subject' => '', 'message' => 'A valid marker message.'])
            ->assertStatus(303);
        $this->postWithCsrf(['name' => $marker, 'email' => 'bad', 'subject' => '', 'message' => 'x'])
            ->assertStatus(422);

        foreach (glob(WRITEPATH . 'logs/*.log') ?: [] as $file) {
            $this->assertStringNotContainsString($marker, (string) file_get_contents($file));
        }
    }
}
