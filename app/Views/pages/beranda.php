<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Beranda<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <!-- Alert Selamat Datang -->
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Selamat Datang!</strong> Anda login sebagai
        <?=session('level') == '1' ? 'Admin' : (session('level') == '2' ? 'Operator' : 'User')?>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <!-- Overview untuk Admin -->
    <?php if (session('level') == '1'): ?>
    <div class="row row-gap-2 row-gap-sm-4 row-gap-lg-0 gap-lg-0">
        <div class="col-sm-6 col-lg-3">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-boxes-stacked fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$barang?> Barang</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-house fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$ruangan?> Ruangan</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-users fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$pengguna?> Pengguna</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-cart-flatbed fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$peminjaman?> Peminjaman</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php elseif (session('level') == '2'): ?>
    <!-- Overview untuk Operator -->
    <div class="row row-gap-2 row-gap-sm-4 row-gap-lg-0 gap-lg-0">
        <div class="col-sm-6 col-lg-4">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-boxes-stacked fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$barang?> Barang</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-house fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$ruangan?> Ruangan</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-cart-flatbed fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$peminjaman?> Peminjaman</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php elseif (session('level') == '3'): ?>
    <!-- Overview untuk User -->
    <div class="row row-gap-2 row-gap-sm-4 row-gap-lg-0 gap-lg-0">
        <div class="col-sm-6 col-lg-4">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-boxes-stacked fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$barang?> Barang</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-house fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$ruangan?> Ruangan</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div
                class="d-flex flex-row border border-3 rounded justify-content-center align-content-center align-items-center py-4">
                <div class="col-4 text-center">
                    <i class="fa fa-cart-flatbed fa-3x"></i>
                </div>
                <div class="col-8">
                    <h4><?=$peminjaman?> Peminjaman</h4>
                    <a href="" class="link-body-emphasis">Lihat detail <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>
<?=$this->endSection();?>