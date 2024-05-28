<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentikasi
$routes->group('auth', function ($routes) {
    $routes->get('login', 'Auth::getLogin');
    $routes->post('login', 'Auth::postLoginAction');
    $routes->get('register', 'Auth::getRegister');
    $routes->post('register', 'Auth::postRegisterAction');
    $routes->get('forgot-password', 'Auth::getForgotPassword');
    $routes->post('forgot-password', 'Auth::postForgotPasswordAction');
    $routes->get('logout', 'Auth::getLogout');
});

// Group Session Auth
$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Beranda
    $routes->get('beranda', 'Beranda::index');

    // Manajemen User
    $routes->group('manajemen-akun', function ($routes) {
        $routes->get('/', 'Admin\ManajemenAkun::index');
        $routes->get('tambah', 'Admin\ManajemenAkun::tambah');
        $routes->post('tambah', 'Admin\ManajemenAkun::tambahAction');
        $routes->get('edit/(:num)', 'Admin\ManajemenAkun::edit/$1');
        $routes->post('edit/(:num)', 'Admin\ManajemenAkun::editAction/$1');
        $routes->get('hapus/(:num)', 'Admin\ManajemenAkun::hapus/$1');
        $routes->get('export-excel', 'Admin\ManajemenAkun::exportToExcel');
        $routes->post('import-excel', 'Admin\ManajemenAkun::importFromExcel');
        $routes->get('download-excel', 'Admin\ManajemenAkun::downloadExcel');

    });

    // Data Ruangan
    $routes->group('data-ruangan', function ($routes) {
        $routes->get('/', 'Admin\DataRuangan::index');
        $routes->post('tambah', 'Admin\DataRuangan::tambahAction');
        $routes->post('edit/(:num)', 'Admin\DataRuangan::editAction/$1');
        $routes->get('hapus/(:num)', 'Admin\DataRuangan::hapus/$1');
        $routes->get('export-excel', 'Admin\DataRuangan::exportToExcel');
        $routes->post('import-excel', 'Admin\DataRuangan::importFromExcel');
        $routes->get('download-excel', 'Admin\DataRuangan::downloadExcel');
    });

    // Data Inventaris
    $routes->group('data-inventaris', function ($routes) {
        $routes->get('/', 'Admin\DataInventaris::index');
        $routes->get('tambah', 'Admin\DataInventaris::tambah');
        $routes->post('tambah', 'Admin\DataInventaris::tambahAction');
        $routes->get('edit/(:num)', 'Admin\DataInventaris::edit/$1');
        $routes->post('edit/(:num)', 'Admin\DataInventaris::editAction/$1');
        $routes->get('hapus/(:num)', 'Admin\DataInventaris::hapus/$1');
        $routes->get('export-excel', 'Admin\DataInventaris::exportToExcel');
        $routes->post('import-excel', 'Admin\DataInventaris::importFromExcel');
        $routes->get('download-excel', 'Admin\DataInventaris::downloadExcel');
    });

    // Operator Transaksi Peminjaman
    $routes->group('peminjaman', function ($routes) {
        $routes->get('/', 'Operator\Peminjaman::index');
        $routes->get('tambah', 'Operator\Peminjaman::tambah');
        //Keranjang
        $routes->post('tambah-item-keranjang', 'Operator\Peminjaman::tambahItemKeranjang');
        $routes->get('hapus-item-keranjang/(:any)', 'Operator\Peminjaman::hapusItemKeranjang/$1');
        $routes->get('hapus-keranjang', 'Operator\Peminjaman::hapusKeranjang');

        $routes->post('tambah', 'Operator\Peminjaman::tambahAction');
        $routes->get('lihat/(:num)', 'Operator\Peminjaman::lihat/$1');
        $routes->get('edit/(:num)', 'Operator\Peminjaman::edit/$1');
        $routes->post('edit/(:num)', 'Operator\Peminjaman::editAction/$1');
        $routes->get('hapus/(:num)', 'Operator\Peminjaman::hapus/$1');
    });

    // Peminjam Transaksi Peminjaman
    $routes->group('user/peminjaman', function ($routes) {
        $routes->get('/', 'User\Peminjaman::index');
        $routes->get('tambah', 'User\Peminjaman::tambah');
        //Keranjang
        $routes->post('tambah-item-keranjang', 'User\Peminjaman::tambahItemKeranjang');
        $routes->get('hapus-item-keranjang/(:any)', 'User\Peminjaman::hapusItemKeranjang/$1');
        $routes->get('hapus-keranjang', 'User\Peminjaman::hapusKeranjang');

        $routes->post('tambah', 'User\Peminjaman::tambahAction');
        $routes->get('lihat/(:num)', 'User\Peminjaman::lihat/$1');
        $routes->get('edit/(:num)', 'User\Peminjaman::edit/$1');
        $routes->post('edit/(:num)', 'User\Peminjaman::editAction/$1');
        $routes->get('hapus/(:num)', 'User\Peminjaman::hapus/$1');
    });

    $routes->group('utility', function ($routes) {
        $routes->get('/', 'Utility::index');
        $routes->get('database-dump', 'Utility::databaseDump');
        $routes->get('table-dump/(:any)', 'Utility::tableDump/$1');
        $routes->get('download/(:any)', 'Utility::download/$1');
        $routes->get('hapus/(:any)', 'Utility::delete/$1');
        $routes->get('hapus-semua', 'Utility::deleteAll');
        $routes->get('database-dump-excel', 'Utility::dumpDatabaseToExcel');
        $routes->get('restore-from-excel/(:any)', 'Utility::restoreFromExcel/$1');
    });

});
