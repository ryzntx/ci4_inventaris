<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?= $this->renderSection('title'); ?> &mdash; Admin Inventaris</title>
        <!-- Styles -->
        <?= $this->include('layouts/includes/styles'); ?>
    </head>

    <body>
        <!-- Navbar -->
        <?= $this->include('layouts/includes/navbar'); ?>
        <div class="container-fluid">
            <div class="row row flex-nowrap">
                <!-- Sidebar/Sidemenu -->
                <?= $this->include('layouts/includes/sidebar'); ?>
                <div class="col">
                    <section class="py-4 py-xl-5">
                        <!-- content -->
                        <?= $this->renderSection('content'); ?>
                    </section>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <?= $this->include('layouts/includes/scripts'); ?>
        <?= $this->renderSection('scripts'); ?>
    </body>

</html>