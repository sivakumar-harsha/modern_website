<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
/**
 * Variables: $errors (field => message), $sent (bool).
 * Submitted values are read from the request here rather than passed as view data, so they are not
 * retained by anything that records view data (e.g. the development debug toolbar).
 * Every dynamic value is escaped with esc(); on success nothing submitted is shown.
 */
$old        = static fn (string $f): string => $sent ? '' : (string) (service('request')->getPost($f) ?? '');
$fieldClass = static fn (string $f): string => 'form-control' . (isset($errors[$f]) ? ' is-invalid' : '');
$invalid    = static fn (string $f): string => isset($errors[$f]) ? ' aria-invalid="true"' : '';
$describe   = static fn (string $f, string $hint = ''): string => trim($hint . (isset($errors[$f]) ? " {$f}-error" : ''));
?>
<?= $this->setVar('heading', 'Contact')->setVar('lead', 'Send a message using the form below. Placeholder page.')->include('partials/public/page_header') ?>

<section class="section">
    <div class="container-app">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-7">
                <div class="alert alert-info" role="note">
                    <strong>Demonstration form.</strong> Messages are not emailed or saved anywhere.
                </div>

                <?php if ($sent): ?>
                    <div class="alert alert-success" role="status" tabindex="-1" data-focus-on-load>
                        <strong>Thank you. This is a demonstration.</strong>
                        Your message passed validation, but no email was sent and no information was stored.
                    </div>
                <?php endif; ?>

                <?php if ($errors): ?>
                    <div class="alert alert-danger" role="alert" tabindex="-1" data-focus-on-load>
                        <strong>Please fix the following:</strong>
                        <ul class="mb-0 mt-1">
                            <?php foreach ($errors as $field => $message): ?>
                                <li><a href="#<?= esc($field, 'attr') ?>"><?= esc($message) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('contact') ?>" method="post" novalidate class="card card-body stack" aria-labelledby="form-title">
                    <h2 class="h4 mb-0" id="form-title">Send a message</h2>

                    <div>
                        <label class="form-label" for="name">Name <span class="text-danger" aria-hidden="true">*</span></label>
                        <input class="<?= $fieldClass('name') ?>" type="text" id="name" name="name" maxlength="100" required autocomplete="name"
                               value="<?= esc($old('name'), 'attr') ?>"<?= $invalid('name') ?> aria-describedby="<?= esc($describe('name'), 'attr') ?>">
                        <?php if (isset($errors['name'])): ?><div class="invalid-feedback d-block" id="name-error"><?= esc($errors['name']) ?></div><?php endif; ?>
                    </div>

                    <div>
                        <label class="form-label" for="email">Email <span class="text-danger" aria-hidden="true">*</span></label>
                        <input class="<?= $fieldClass('email') ?>" type="email" id="email" name="email" maxlength="254" required autocomplete="email"
                               value="<?= esc($old('email'), 'attr') ?>"<?= $invalid('email') ?> aria-describedby="<?= esc($describe('email'), 'attr') ?>">
                        <?php if (isset($errors['email'])): ?><div class="invalid-feedback d-block" id="email-error"><?= esc($errors['email']) ?></div><?php endif; ?>
                    </div>

                    <div>
                        <label class="form-label" for="subject">Subject <span class="text-muted fw-normal">(optional)</span></label>
                        <input class="<?= $fieldClass('subject') ?>" type="text" id="subject" name="subject" maxlength="150"
                               value="<?= esc($old('subject'), 'attr') ?>"<?= $invalid('subject') ?> aria-describedby="<?= esc($describe('subject'), 'attr') ?>">
                        <?php if (isset($errors['subject'])): ?><div class="invalid-feedback d-block" id="subject-error"><?= esc($errors['subject']) ?></div><?php endif; ?>
                    </div>

                    <div>
                        <label class="form-label" for="message">Message <span class="text-danger" aria-hidden="true">*</span></label>
                        <textarea class="<?= $fieldClass('message') ?>" id="message" name="message" rows="5" maxlength="2000" required<?= $invalid('message') ?>
                                  aria-describedby="<?= esc($describe('message', 'message-hint'), 'attr') ?>"><?= esc($old('message')) ?></textarea>
                        <div class="form-text" id="message-hint">10 to 2000 characters.</div>
                        <?php if (isset($errors['message'])): ?><div class="invalid-feedback d-block" id="message-error"><?= esc($errors['message']) ?></div><?php endif; ?>
                    </div>

                    <?= csrf_field() ?>
                    <div><button class="btn btn-primary" type="submit">Send message</button> <span class="form-text ms-2"><span aria-hidden="true">*</span> Required</span></div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h4">Contact details <span class="placeholder-note ms-1">Placeholder</span></h2>
                        <ul class="list-unstyled mb-0 stack stack-sm">
                            <li><i class="bi bi-geo-alt text-primary me-2" aria-hidden="true"></i>[Business address]</li>
                            <li><i class="bi bi-telephone text-primary me-2" aria-hidden="true"></i>[Phone number]</li>
                            <li><i class="bi bi-envelope text-primary me-2" aria-hidden="true"></i>[Email address]</li>
                            <li><i class="bi bi-clock text-primary me-2" aria-hidden="true"></i>[Opening hours]</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/pages/contact.js') ?>"></script>
<?= $this->endSection() ?>
