<?= $this->extend('layouts/public') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/home.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
// All copy below is generic placeholder content to be replaced by the business owner.
$services = [
    ['bi-compass',        'Strategy &amp; Planning',   'Placeholder text describing a service in one or two short sentences.'],
    ['bi-pencil-square',  'Design &amp; Build',        'Placeholder text describing a service in one or two short sentences.'],
    ['bi-gear',           'Operations Support',        'Placeholder text describing a service in one or two short sentences.'],
    ['bi-mortarboard',    'Training &amp; Guidance',   'Placeholder text describing a service in one or two short sentences.'],
    ['bi-shield-check',   'Maintenance &amp; Care',    'Placeholder text describing a service in one or two short sentences.'],
    ['bi-bar-chart-line', 'Reporting &amp; Insight',   'Placeholder text describing a service in one or two short sentences.'],
];
$benefits = [
    ['bi-bullseye',       'Clear focus',        'Placeholder: a short benefit statement goes here.'],
    ['bi-people',         'Dedicated support',  'Placeholder: a short benefit statement goes here.'],
    ['bi-speedometer2',   'Efficient delivery', 'Placeholder: a short benefit statement goes here.'],
    ['bi-arrows-angle-expand', 'Room to grow',  'Placeholder: a short benefit statement goes here.'],
];
$steps = [
    ['Discover', 'Placeholder: describe the first step in a sentence.'],
    ['Plan',     'Placeholder: describe the second step in a sentence.'],
    ['Deliver',  'Placeholder: describe the third step in a sentence.'],
    ['Support',  'Placeholder: describe the fourth step in a sentence.'],
];
?>

<!-- 1. Hero -->
<section class="hero hero-home">
    <div class="container-app">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6">
                <span class="eyebrow" data-reveal>Your Business Name</span>
                <h1 class="text-balance" data-reveal style="--reveal-delay: 60ms">A clear headline that explains what you offer</h1>
                <p class="lead text-muted measure" data-reveal style="--reveal-delay: 120ms">
                    A concise supporting sentence about who you help and how. Replace this placeholder with your own message.
                </p>
                <div class="cluster" data-reveal style="--reveal-delay: 180ms">
                    <a class="btn btn-primary btn-lg" href="<?= base_url('contact') ?>">Get in touch</a>
                    <a class="btn btn-light btn-lg" href="<?= base_url('services') ?>">Explore services</a>
                </div>
            </div>
            <div class="col-lg-6" data-reveal style="--reveal-delay: 120ms">
                <div class="hero-art" aria-hidden="true">
                    <svg viewBox="0 0 480 320" role="presentation" focusable="false">
                        <defs>
                            <linearGradient id="g-main" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="#1f4fd8"/><stop offset="1" stop-color="#163a9e"/>
                            </linearGradient>
                            <linearGradient id="g-acc" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="#0fa3a3"/><stop offset="1" stop-color="#1f4fd8"/>
                            </linearGradient>
                        </defs>
                        <rect x="40" y="30" width="300" height="200" rx="14" fill="#fff" stroke="#e2e8f0"/>
                        <rect x="40" y="30" width="300" height="34" rx="14" fill="#e8eefc"/>
                        <circle cx="62" cy="47" r="4" fill="#1f4fd8"/><circle cx="76" cy="47" r="4" fill="#0fa3a3"/><circle cx="90" cy="47" r="4" fill="#cbd5e1"/>
                        <rect x="62" y="86" width="120" height="10" rx="5" fill="#0f172a" opacity=".85"/>
                        <rect x="62" y="108" width="200" height="8" rx="4" fill="#cbd5e1"/>
                        <rect x="62" y="124" width="170" height="8" rx="4" fill="#e2e8f0"/>
                        <rect x="62" y="170" width="28" height="44" rx="5" fill="url(#g-acc)"/>
                        <rect x="100" y="150" width="28" height="64" rx="5" fill="url(#g-main)"/>
                        <rect x="138" y="134" width="28" height="80" rx="5" fill="url(#g-acc)"/>
                        <rect x="176" y="158" width="28" height="56" rx="5" fill="url(#g-main)"/>
                        <rect x="214" y="120" width="28" height="94" rx="5" fill="url(#g-acc)"/>
                        <rect x="230" y="150" width="190" height="130" rx="14" fill="url(#g-main)"/>
                        <circle cx="270" cy="190" r="16" fill="#fff" opacity=".18"/>
                        <rect x="298" y="182" width="96" height="8" rx="4" fill="#fff" opacity=".85"/>
                        <rect x="298" y="198" width="64" height="8" rx="4" fill="#fff" opacity=".45"/>
                        <rect x="256" y="230" width="140" height="8" rx="4" fill="#fff" opacity=".3"/>
                        <circle cx="400" cy="60" r="34" fill="#e0f5f5"/>
                        <path d="M386 62l9 9 17-20" fill="none" stroke="#0fa3a3" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Services overview -->
<section class="section" id="services">
    <div class="container-app">
        <div class="section-head" data-reveal>
            <span class="eyebrow">Services</span>
            <h2>What we can help with</h2>
            <p>A short overview of the main areas of work. Placeholder content.</p>
        </div>
        <div class="row g-3">
            <?php foreach ($services as $i => [$icon, $name, $text]): ?>
                <div class="col-sm-6 col-lg-4">
                    <article class="card card-hover h-100" data-reveal style="--reveal-delay: <?= ($i % 3) * 60 ?>ms">
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

<!-- 3. Benefits -->
<section class="section section--alt" id="benefits">
    <div class="container-app">
        <div class="section-head" data-reveal>
            <span class="eyebrow">Why choose us</span>
            <h2>Built around what matters to you</h2>
            <p>Placeholder capabilities. Replace with real strengths once they are confirmed.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($benefits as $i => [$icon, $name, $text]): ?>
                <div class="col-sm-6 col-lg-3" data-reveal style="--reveal-delay: <?= $i * 60 ?>ms">
                    <div class="benefit">
                        <i class="bi <?= $icon ?> benefit-icon" aria-hidden="true"></i>
                        <div>
                            <h3 class="h4 mb-1"><?= $name ?></h3>
                            <p class="mb-0 text-muted"><?= $text ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 4. Visual feature -->
<section class="section" id="feature">
    <div class="container-app">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6 order-lg-2" data-reveal>
                <span class="eyebrow">Feature</span>
                <h2>One highlighted capability, explained simply</h2>
                <p class="text-muted">A short paragraph about a key feature or approach. Placeholder text to be replaced.</p>
                <ul class="check-list">
                    <li>Placeholder point one</li>
                    <li>Placeholder point two</li>
                    <li>Placeholder point three</li>
                </ul>
            </div>
            <div class="col-lg-6 order-lg-1" data-reveal style="--reveal-delay: 80ms">
                <div class="feature-art" aria-hidden="true">
                    <span class="orb orb-1"></span>
                    <span class="orb orb-2"></span>
                    <div class="feature-card feature-card-a"><i class="bi bi-layers"></i><span></span><span></span></div>
                    <div class="feature-card feature-card-b"><i class="bi bi-lightning-charge"></i><span></span><span></span></div>
                    <div class="feature-card feature-card-c"><i class="bi bi-check2-circle"></i><span></span><span></span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Process -->
<section class="section section--alt" id="process">
    <div class="container-app">
        <div class="section-head" data-reveal>
            <span class="eyebrow">How it works</span>
            <h2>A simple process</h2>
        </div>
        <ol class="process row g-3 list-unstyled mb-0">
            <?php foreach ($steps as $i => [$name, $text]): ?>
                <li class="col-sm-6 col-lg-3" data-reveal style="--reveal-delay: <?= $i * 60 ?>ms">
                    <div class="process-step">
                        <span class="process-num" aria-hidden="true"><?= $i + 1 ?></span>
                        <h3 class="h4 mb-1"><span class="visually-hidden">Step <?= $i + 1 ?>: </span><?= $name ?></h3>
                        <p class="mb-0 text-muted"><?= $text ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<!-- 6. Final call to action -->
<section class="section">
    <div class="container-app">
        <div class="cta-band" data-reveal>
            <div>
                <h2 class="mb-1">Ready to talk?</h2>
                <p class="mb-0">A short closing line inviting visitors to get in touch. Send a message using the contact page.</p>
            </div>
            <a class="btn btn-light btn-lg" href="<?= base_url('contact') ?>">Contact us</a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
