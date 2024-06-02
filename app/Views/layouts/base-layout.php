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

        <div class="toast-container position-fixed top-0 end-0 p-3">
            <?php if (session()->getFlashdata('success')): ?>
            <div id="notificationToast" class="toast text-bg-success" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-header">
                    <i class="fa fa-check-circle me-2"></i>
                    <strong class="me-auto">Sukses</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?=session()->getFlashdata('success');?>
                </div>
            </div>
            <?php endif;?>
            <?php if (session()->getFlashdata('info')): ?>
            <div id="notificationToast" class="toast text-bg-info" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-header">
                    <i class="fa fa-info-circle me-2"></i>
                    <strong class="me-auto">Info</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?=session()->getFlashdata('info');?>
                </div>
            </div>
            <?php endif;?>
            <?php if (session()->getFlashdata('error')): ?>
            <div id="notificationToast" class="toast text-bg-danger" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-header">
                    <i class="fa fa-xmark-circle me-2"></i>
                    <strong class="me-auto">Error!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?=session()->getFlashdata('error');?>
                </div>
            </div>
            <?php endif;?>
            <?php if (session()->getFlashdata('warning')): ?>
            <div id="notificationToast" class="toast text-bg-warning" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-header">
                    <i class="fa fa-exclamation-circle me-2"></i>
                    <strong class="me-auto">Peringatan!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?=session()->getFlashdata('warning');?>
                </div>
            </div>
            <?php endif;?>
        </div>
        <!-- Scripts -->
        <?=$this->include('layouts/includes/scripts');?>
        <?=$this->renderSection('scripts');?>
        <script>
        const toastLiveExample = document.getElementById('notificationToast')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

        <?php if (session()->getFlashdata('success') || session()->getFlashdata('info') || session()->getFlashdata('error') || session()->getFlashdata('warning')): ?>
        toastBootstrap.show();
        <?php endif;?>
        </script>
    </body>

</html>