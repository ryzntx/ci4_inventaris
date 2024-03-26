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

// Beranda
$routes->get('beranda', 'Beranda::index');
