<?php
/**
 * Public site layout. Pages extend it with $this->extend('layouts/public') and fill the "content" section.
 * Optional page data: $title, $description, $navActive. The admin CMS gets its own layout later.
 */
$siteName    = 'Your Business Name';
$pageTitle   = isset($title) && $title !== '' ? $title . ' | ' . $siteName : $siteName;
$description = $description ?? 'Placeholder description for this website.';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($pageTitle) ?></title>
    <meta name="description" content="<?= esc($description, 'attr') ?>">
    <meta name="theme-color" content="#1F4FD8">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">

    <!-- Vendor -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') ?>">
    <!-- Foundation: core, components, motion, site -->
    <link rel="stylesheet" href="<?= base_url('assets/css/core/tokens.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/typography.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/utilities.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/buttons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/forms.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/cards.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/tables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/nav.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/alerts.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/carousel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components/accordion.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/motion/motion.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/site.css') ?>">
    <?= $this->renderSection('head') ?>
</head>
<body>
    <a class="skip-link" href="#main">Skip to main content</a>

    <?= $this->include('partials/public/header') ?>

    <main id="main" class="site-main" tabindex="-1">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('partials/public/footer') ?>

    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/site.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
