<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'home::index', ['filter' => 'auth']);
$routes->get('/home', 'home::index', ['filter' => 'auth']);
$routes->get('/home/profile', 'home::profile', ['filter' => 'auth']);

$routes->get('/auth', 'Auth::index');
$routes->get('/auth/login', 'Auth::login');
$routes->get('/auth/registrasi', 'Auth::registrasi');

$routes->get('/home/profile', 'Home::profile');
$routes->get('/home/edit-profile', 'Home::editProfile');

$routes->get('/kategori', 'Kategori::index', ['filter' => 'auth']);
$routes->get('/kategori/tambah', 'Kategori::tambah', ['filter' => 'auth']);
$routes->get('/kategori/edit/(:num)', 'Kategori::edit/$1', ['filter' => 'auth']);

$routes->get('/produk', 'Produk::index', ['filter' => 'auth']);
$routes->get('/produk/tambah', 'Produk::tambah', ['filter' => 'auth']);
$routes->get('/produk/edit/(:num)', 'Produk::edit/$1', ['filter' => 'auth']);

$routes->get('/transaksi', 'Transaksi::index', ['filter' => 'auth']);
$routes->get('/transaksi/laporan', 'Transaksi::laporan', ['filter' => 'auth']);


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
