<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class PublicPagesTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    /**
     * @return array<string, array{string, string, string}> path, heading, active nav label
     */
    public static function pageProvider(): array
    {
        return [
            'home'     => ['/', 'A clear headline', 'Home'],
            'about'    => ['about', 'About', 'About'],
            'services' => ['services', 'Services', 'Services'],
            'contact'  => ['contact', 'Contact', 'Contact'],
        ];
    }

    /**
     * @dataProvider pageProvider
     */
    public function testPageRendersWithSharedLayout(string $path, string $needle, string $activeLabel): void
    {
        $result = $this->get($path);

        $result->assertStatus(200);
        $result->assertSee('Your Business Name');
        $result->assertSee($needle);
        $result->assertSee('Skip to main content');
        $this->assertStringContainsString('class="navbar navbar-expand-lg site-navbar', $result->getBody());
        $this->assertStringContainsString('class="site-footer"', $result->getBody());

        // Exactly the current page is marked as active in the navigation.
        $html = $result->getBody();
        $this->assertSame(1, substr_count($html, 'aria-current="page"' . '>' . $activeLabel . '</a>'), 'Active nav link should be ' . $activeLabel);
        $this->assertSame(1, preg_match_all('/nav-link active/', $html));
    }

    public function testNavigationLinksToEveryPublicPage(): void
    {
        $html = $this->get('/')->getBody();

        foreach (['about', 'services', 'contact'] as $path) {
            $this->assertStringContainsString('href="' . base_url($path) . '"', $html);
        }
    }

    public function testUnknownRouteIs404(): void
    {
        $this->expectException(\CodeIgniter\Exceptions\PageNotFoundException::class);

        $this->get('does-not-exist');
    }

    public function testAutoRoutingIsDisabled(): void
    {
        // With auto-routing off, controller/method URLs must not resolve.
        foreach (['pages/about', 'home/index', 'contact/submit'] as $path) {
            try {
                $this->get($path);
                $this->fail("'{$path}' should not resolve");
            } catch (\CodeIgniter\Exceptions\PageNotFoundException) {
                $this->addToAssertionCount(1);
            }
        }
    }
}
