<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

/**
 * Demonstration contact form. Submissions are validated and then discarded:
 * nothing is emailed, stored in a database or written to the logs.
 */
class Contact extends BaseController
{
    protected $helpers = ['form'];

    /** @var array<string, string> */
    private const RULES = [
        'name'    => 'required|min_length[2]|max_length[100]',
        'email'   => 'required|valid_email|max_length[254]',
        'subject' => 'permit_empty|max_length[150]',
        'message' => 'required|min_length[10]|max_length[2000]',
    ];

    private const FLASH_KEY = 'contact_sent';

    public function index(): string
    {
        return $this->render(['sent' => (bool) session()->getFlashdata(self::FLASH_KEY)]);
    }

    public function submit(): string|ResponseInterface
    {
        if (! $this->validate(self::RULES)) {
            $body = $this->render(['errors' => $this->validator->getErrors()]);
            $this->discardSubmission();

            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY)
                ->setBody($body);
        }

        // Valid: flash a constant marker only (never the submitted values) and redirect, so a
        // refresh of the result page repeats the GET rather than resubmitting the POST.
        $this->discardSubmission();
        session()->setFlashdata(self::FLASH_KEY, true);

        return redirect()->to(base_url('contact'), 303);
    }

    /**
     * Drops the submitted form data once the response body is built, so that nothing
     * downstream (for example the development debug toolbar's request history) can record it.
     */
    private function discardSubmission(): void
    {
        $_POST = [];
        $this->request->setGlobal('post', []);
    }

    /** @param array<string, mixed> $extra */
    private function render(array $extra = []): string
    {
        return view('pages/contact', $extra + [
            'title'       => 'Contact',
            'description' => 'Placeholder contact page with a demonstration form.',
            'navActive'   => 'contact',
            'errors'      => [],
            'sent'        => false,
        ]);
    }
}
