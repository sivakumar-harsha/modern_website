<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
// Generic placeholder content to be replaced by the business owner.
$points = [
    ['bi-bullseye', 'Our purpose',  'Placeholder: a short statement of why the business exists and who it serves.'],
    ['bi-compass',  'Our approach', 'Placeholder: a short description of how the work is planned and carried out.'],
    ['bi-heart',    'Our values',   'Placeholder: a short statement of the principles that guide decisions.'],
];
?>
<?= $this->setVar('heading', 'About')->setVar('lead', 'A short introduction to the business. Placeholder content.')->include('partials/public/page_header') ?>

<section class="section">
    <div class="container-app">
        <div class="row g-4 g-lg-5 align-items-start">
            <div class="col-lg-7" data-reveal>
                <span class="eyebrow">Who we are</span>
                <h2>Introduction</h2>
                <p>Placeholder paragraph introducing the business in plain language. Replace this text with an accurate description once it is available.</p>
                <p class="mb-0">A second placeholder paragraph can cover the kinds of customers served and what they can expect when working together.</p>
            </div>
            <div class="col-lg-5" data-reveal style="--reveal-delay: 80ms">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="h4">At a glance</h2>
                        <ul class="check-list mb-0">
                            <li>Placeholder point one</li>
                            <li>Placeholder point two</li>
                            <li>Placeholder point three</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section--alt">
    <div class="container-app">
        <div class="section-head" data-reveal>
            <span class="eyebrow">Purpose &amp; approach</span>
            <h2>What guides the work</h2>
        </div>
        <div class="row g-3">
            <?php foreach ($points as $i => [$icon, $name, $text]): ?>
                <div class="col-md-4">
                    <article class="card card-hover h-100" data-reveal style="--reveal-delay: <?= $i * 60 ?>ms">
                        <div class="card-body">
                            <span class="icon-badge"><i class="bi <?= $icon ?>" aria-hidden="true"></i></span>
                            <h3 class="card-title"><?= $name ?></h3>
                            <p class="card-text mb-0"><?= $text ?></p>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-app">
        <div class="cta-band" data-reveal>
            <div>
                <h2 class="mb-1">Want to know more?</h2>
                <p class="mb-0">A short closing line inviting visitors to get in touch.</p>
            </div>
            <a class="btn btn-light btn-lg" href="<?= base_url('contact') ?>">Contact us</a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
