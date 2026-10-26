<?php
/** Public header + primary navigation. $navActive is the key of the current page. */
$siteName  = 'Your Business Name';
$navActive = $navActive ?? '';
$navItems  = [
    'home'     => ['label' => 'Home',     'href' => base_url()],
    'about'    => ['label' => 'About',    'href' => base_url('about')],
    'services' => ['label' => 'Services', 'href' => base_url('services')],
    'contact'  => ['label' => 'Contact',  'href' => base_url('contact')],
];
?>
<header>
    <nav class="navbar navbar-expand-lg site-navbar sticky-top" aria-label="Primary">
        <div class="container-app d-flex flex-wrap align-items-center">
            <a class="navbar-brand" href="<?= base_url() ?>"><?= esc($siteName) ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-nav"
                    aria-controls="primary-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="primary-nav">
                <ul class="navbar-nav ms-lg-auto">
                    <?php foreach ($navItems as $key => $item): ?>
                        <li class="nav-item">
                            <a class="nav-link<?= $navActive === $key ? ' active' : '' ?>"
                               href="<?= esc($item['href'], 'attr') ?>"<?= $navActive === $key ? ' aria-current="page"' : '' ?>><?= esc($item['label']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
