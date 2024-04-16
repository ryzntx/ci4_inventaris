<div class="col col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div
        class="d-xxl-flex justify-content-xxl-center align-items-xxl-center d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <div class="d-flex flex-column justify-content-center align-items-center align-content-center dropdown pb-4">
            <img class="rounded-circle" src="<?= base_url('assets/img/hczKIze.jpg') ?>" width="50" height="50">
            <h4 class="text-center">Hi, <?= model('UserModel')->ambilDataLogin()->nama ?></h4>
            <h5 class="badge bg-success">
                <?= model('UserModel')->joinLevelWhere(session()->get('id_user'))->nama_level ?></h5>
        </div>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item"><a href="<?= base_url('beranda') ?>" class="nav-link align-middle px-0"><i
                        class="fa fa-home fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span></a></li>
            <li class="nav-item"><a href="<?= base_url('manajemen-akun') ?>" class="nav-link align-middle px-0"><i
                        class="fa fa-users fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Manajemen
                        User</span></a></li>
            <li class="nav-item"><a href="<?= base_url('data-ruangan') ?>" class="nav-link align-middle px-0"><i
                        class="fa fa-building fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Data
                        Ruangan</span></a></li>
            <li class="nav-item"><a href="<?= base_url('data-inventaris') ?>" class="nav-link align-middle px-0"><i
                        class="fa fa-box fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Data
                        Barang</span></a></li>
            <li><a href="<?= base_url('peminjaman') ?>" class="nav-link px-0 align-middle"><i
                        class="fa fa-table fs-4 bi-table"></i><span
                        class="ms-1 d-none d-sm-inline">Peminjaman</span></a></li>

        </ul>
        <hr>
    </div>
</div>