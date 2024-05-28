<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div
                    class="d-flex flex-column justify-content-center align-items-center align-content-center dropdown my-4">
                    <?php if (!model('UserModel')->ambilDataLogin()->foto): ?>
                    <img class="rounded-circle" src="<?=base_url('assets/img/hczKIze.jpg')?>" width="50" height="50">
                    <?php else: ?>
                    <img class="rounded-circle"
                        src="<?=base_url('uploads/foto/' . model('UserModel')->ambilDataLogin()->foto)?>" width="50"
                        height="50">
                    <?php endif;?>
                    <h4 class="text-center">Hi, <?=model('UserModel')->ambilDataLogin()->nama?></h4>
                    <h5 class="badge bg-success">
                        <?=model('UserModel')->joinLevelWhere(session()->get('id_user'))->nama_level?></h5>
                </div>
                <a class="nav-link" href="<?=base_url('beranda')?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Beranda
                </a>
                <div class="sb-sidenav-menu-heading">Master</div>
                <a class="nav-link" href="<?=base_url('manajemen-akun')?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Manajemen Akun
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                    Data Master
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?=base_url('data-ruangan')?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-landmark"></i></div>Data Ruangan
                        </a>
                        <a class="nav-link" href="<?=base_url('data-inventaris')?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-boxes-stacked"></i></div>Data Inventaris
                        </a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Transaksi</div>
                <a class="nav-link" href="<?=base_url('peminjaman')?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                    Peminjaman
                </a>
                <div class="sb-sidenav-menu-heading">Lain-lain</div>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                    Laporan
                </a>
                <a class="nav-link" href="<?=base_url('utility')?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-gears"></i></div>
                    Utilitas
                </a>
                <div class="sb-sidenav-menu-heading">Menu User</div>
                <a class="nav-link" href="<?=base_url('user/peminjaman')?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                    Peminjaman
                </a>

            </div>
        </div>
        <!-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div> -->
    </nav>
</div>