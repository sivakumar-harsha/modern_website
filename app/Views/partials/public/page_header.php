<?php
/** Inner-page heading with breadcrumb. Expects $heading and $lead. */
?>
<section class="page-header">
    <div class="container-app">
        <nav aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($heading) ?></li>
            </ol>
        </nav>
        <h1><?= esc($heading) ?></h1>
        <p class="lead text-muted measure mb-0"><?= esc($lead) ?></p>
    </div>
</section>
