<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
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

// create db
$routes->get('create-db', function() {
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('yuknikah')) {
        echo 'Database created!';
    }
});

// login
$routes->get('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// $routes->get('/', 'Home::index');
$routes->addRedirect('/', 'home');

// master gawe
$routes->get('gawe', 'Gawe::index');
// add
$routes->get('gawe/add', 'Gawe::create');
$routes->post('gawe', 'Gawe::store');
// edit
$routes->get('gawe/edit/(:num)', 'Gawe::edit/$1');
$routes->PUT('gawe/(:any)', 'Gawe::update/$1');
// delete
$routes->DELETE('gawe/(:segment)', 'Gawe::delete/$1');

// deleted with ajax
$routes->GET('gawe/(:segment)', 'Gawe::deleteAjax/$1');


// master grup kontak
// cosutm resource harus di atas nya routes resource / presenter
$routes->get('groups/trash', 'Groups::trash'); 
$routes->get('groups/restore/(:any)', 'Groups::restore/$1');
$routes->get('groups/restore', 'Groups::restore');
$routes->delete('groups/delete2/(:any)', 'Groups::delete2/$1');
$routes->delete('groups/delete2', 'Groups::delete2');
$routes->resource('groups', ['filter' => 'isLoggedIn']);

// routes kontak
$routes->get('kontak/export', 'kontak::export');
$routes->resource('kontak', ['filter' => 'isLoggedIn']);

// pakai presenter perbedaanannya terlihat di routes nya
// $routes->presenter('groups', ['filter' => 'isLoggedIn']);


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
