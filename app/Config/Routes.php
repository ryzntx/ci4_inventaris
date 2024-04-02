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
        $routes->get('/', 'ManajemenAkun::index');
        $routes->get('tambah', 'ManajemenAkun::tambah');
        $routes->post('tambah', 'ManajemenAkun::tambahAction');
        $routes->get('edit/(:num)', 'ManajemenAkun::edit/$1');
        $routes->post('edit/(:num)', 'ManajemenAkun::editAction/$1');
        $routes->get('hapus/(:num)', 'ManajemenAkun::hapus/$1');
    });

    // Data Ruangan
    $routes->group('data-ruangan', function ($routes) {
        $routes->get('/', 'DataRuangan::index');
        $routes->post('tambah', 'DataRuangan::tambahAction');
        $routes->post('edit/(:num)', 'DataRuangan::editAction/$1');
        $routes->get('hapus/(:num)', 'DataRuangan::hapus/$1');
    });

    // Data Inventaris
    $routes->group('data-inventaris', function ($routes) {
        $routes->get('/', 'DataInventaris::index');
        $routes->get('tambah', 'DataInventaris::tambah');
        $routes->post('tambah', 'DataInventaris::tambahAction');
        $routes->get('edit/(:num)', 'DataInventaris::edit/$1');
        $routes->post('edit/(:num)', 'DataInventaris::editAction/$1');
        $routes->get('hapus/(:num)', 'DataInventaris::hapus/$1');
    });
});
