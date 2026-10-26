<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php
// Generic placeholder content to be replaced by the business owner.
$services = [
    ['bi-compass',        'Strategy &amp; Planning'],
    ['bi-pencil-square',  'Design &amp; Build'],
    ['bi-gear',           'Operations Support'],
    ['bi-mortarboard',    'Training &amp; Guidance'],
    ['bi-shield-check',   'Maintenance &amp; Care'],
    ['bi-bar-chart-line', 'Reporting &amp; Insight'],
];
?>
<?= $this->setVar('heading', 'Services')->setVar('lead', 'An overview of the areas of work. Placeholder content.')->include('partials/public/page_header') ?>

<section class="section">
    <div class="container-app">
        <div class="row g-3">
            <?php foreach ($services as $i => [$icon, $name]): ?>
                <div class="col-md-6">
                    <article class="card card-hover h-100" data-reveal style="--reveal-delay: <?= ($i % 2) * 60 ?>ms">
                        <div class="card-body d-flex gap-3">
                            <span class="icon-badge flex-shrink-0"><i class="bi <?= $icon ?>" aria-hidden="true"></i></span>
                            <div>
                                <h2 class="card-title h3"><?= $name ?></h2>
                                <p class="card-text">Placeholder paragraph describing this service in two or three short sentences. Replace it with an accurate description.</p>
                                <ul class="check-list small mb-0">
                                    <li>Placeholder detail one</li>
                                    <li>Placeholder detail two</li>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section pt-0">
    <div class="container-app">
        <div class="cta-band" data-reveal>
            <div>
                <h2 class="mb-1">Not sure which service fits?</h2>
                <p class="mb-0">A short closing line inviting visitors to ask a question.</p>
            </div>
            <a class="btn btn-light btn-lg" href="<?= base_url('contact') ?>">Contact us</a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
