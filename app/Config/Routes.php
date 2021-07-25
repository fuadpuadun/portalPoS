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
$routes->setDefaultController('Portal');
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

# Index
$routes->add('/', 'c_home::index');

# Beranda
$routes->add('/home', 'c_home::index');

# Sign in
$routes->add('/signin', 'c_signin::index');
$routes->add('/signin/send', 'c_signin::send');

# Sign up
$routes->add('/signup', 'c_signup::index');
$routes->add('/signup/send', 'c_signup::send');

# Sign out
$routes->add('/signout', 'c_signout::index');

# Barang
$routes->add('/item', 'c_item::index');
$routes->add('/item/search', 'c_item::search');

# Keranjang
$routes->add('/cart', 'c_cart::index');
$routes->add('/cart/update', 'c_cart::update');

# Kelola Barang
$routes->add('/manage', 'c_manage::manage');


// $routes->add('/cart', 'c_home::cart');
// $routes->add('/cartref', 'c_home::cartref');
$routes->add('/itemman', 'c_home::itemman');
$routes->add('/sale', 'c_home::sale');
$routes->add('/sale_detail', 'c_home::sale_detail');
$routes->add('/sale_payoff', 'c_home::sale_payoff');

$routes->get('/removeitemcart/(:any)', 'c_home::removeItemCart/$1');
$routes->get('/clearcart', 'c_home::clearCart');

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
