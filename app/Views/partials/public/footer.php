<?php
/** Public footer. All contact details are placeholders until the owner supplies real ones. */
$siteName = 'Your Business Name';
?>
<footer class="site-footer">
    <div class="container-app">
        <div class="row g-4">
            <div class="col-md-6">
                <p class="fw-semibold text-body mb-1"><?= esc($siteName) ?></p>
                <p class="mb-0">Short business description goes here.</p>
            </div>
            <div class="col-md-6" id="contact">
                <p class="fw-semibold text-body mb-1">Contact <span class="placeholder-note ms-1">Placeholder</span></p>
                <ul class="list-unstyled mb-0">
                    <li>Address: [Business address]</li>
                    <li>Phone: [Phone number]</li>
                    <li>Email: [Email address]</li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <p class="mb-0">&copy; <?= date('Y') ?> <?= esc($siteName) ?>. All rights reserved.</p>
    </div>
</footer>
