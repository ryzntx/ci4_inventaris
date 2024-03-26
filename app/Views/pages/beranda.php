<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Inventaris</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:300,400,500,600,700&amp;display=swap">
    <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/Navbar-Right-Links-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark ">
        <div class="d-flex flex-fill px-3">
            <a class="navbar-brand d-flex align-items-center" href="#"><img src="<?= base_url('assets/img/clipboard-image.png') ?>" width="60">
                <span class="text-light fs-6 ms-2">Sarana &amp; Prasana <br> SMP Negeri 1 Subang</span></a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto"></ul><a class="btn btn-primary ms-md-2" role="button" href="<?= base_url('auth/logout') ?>">Keluar</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row row flex-nowrap">
            <div class="col col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-xxl-flex justify-content-xxl-center align-items-xxl-center d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <div class="d-flex flex-column justify-content-center align-items-center align-content-center dropdown pb-4">
                        <img class="rounded-circle" src="<?= base_url('assets/img/hczKIze.jpg') ?>" width="50" height="50">
                        <h4 class="text-center">Hi, <?= model('UserModel')->ambilDataLogin()->nama ?></h4>
                        <h5 class="badge bg-success">
                            <?= model('UserModel')->joinLevelWhere(session()->get('id_user'))->nama_level ?></h5>
                    </div>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item"><a href="#" class="nav-link align-middle px-0"><i class="fa fa-home fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span></a></li>
                        <li class="nav-item"><a class="nav-link px-0 align-middle dropdown-toggle" href="#submenu1" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="submenu1"><i class="fa fa-bar-chart fs-4 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                            <ul id="submenu1" class="nav flex-column ms-1 collapse ms-1 ms-md-3">
                                <li class="w-100"><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Item</span></a></li>
                                <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Item</span></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="nav-link px-0 align-middle"><i class="fa fa-table fs-4 bi-table"></i><span class="ms-1 d-none d-sm-inline">Orders</span></a></li>
                        <li><a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fa fa-glass fs-4 bi-bootstrap"></i><span class="ms-1 d-none d-sm-inline">Lounge</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100"><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Item</span></a></li>
                                <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Item</span></a></li>
                            </ul>
                        </li>
                        <li><a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fa fa-th-large fs-4 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Products</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100"><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Product</span></a></li>
                                <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Product</span></a></li>
                                <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Product</span></a></li>
                                <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Product</span></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="nav-link px-0 align-middle"><i class="fa fa-users fs-4 bi-people"></i><span class="ms-1 d-none d-sm-inline">Customers</span></a></li>
                    </ul>
                    <hr>
                </div>
            </div>
            <div class="col">
                <section class="py-4 py-xl-5">
                    <div class="container">
                        <div class="text-white bg-dark border rounded border-0 p-4 p-md-5">
                            <h2 class="fw-bold text-white mb-3">Biben dum fringi dictum, augue purus</h2>
                            <p class="mb-4">Tincidunt laoreet leo, adipiscing taciti tempor. Primis senectus sapien,
                                risus donec ad fusce augue interdum.</p>
                            <div class="my-3"><a class="btn btn-primary btn-lg me-2" role="button" href="#">Button</a><a class="btn btn-light btn-lg" role="button" href="#">Button</a></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>

</html>