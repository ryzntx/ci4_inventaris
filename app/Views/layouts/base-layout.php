<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?=$this->renderSection('title');?> &mdash; Admin Inventaris</title>
        <!-- Styles -->
        <?=$this->include('layouts/includes/styles');?>
    </head>

    <body class="sb-nav-fixed">
        <!-- Navbar -->
        <?=$this->include('layouts/includes/navbar');?>
        <div id="layoutSidenav">
            <!-- Sidebar/Sidemenu -->
            <?=$this->include('layouts/includes/sidebar');?>
            <div id="layoutSidenav_content">
                <main>
                    <!-- content -->
                    <?=$this->renderSection('content');?>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Kelompok 2 Workshop Permrograman <?=date('Y')?>
                            </div>

                        </div>
                    </div>
                </footer>
            </div>

        </div>
        <!-- Scripts -->
        <?=$this->include('layouts/includes/scripts');?>
        <?=$this->renderSection('scripts');?>
    </body>

</html>