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
$routes->get('/', 'Home::index');
$routes->get('/productos/registro', 'Productos::index');
$routes->post('/productos/registro/nuevo', 'Productos::registrar');
$routes->get('/productos/listado', 'Productos::buscar');
$routes->delete('/productos/eliminar/(:num)', 'Productos::eliminar/$1');
$routes->post('/productos/editar/(:num)', 'Productos::editar/$1');

$routes->get('/animales/registro', 'Animales::index');
$routes->get('/animales/listado', 'Animales::buscar');
$routes->post('/animales/registro/nuevo', 'Animales::registrar');
$routes->get('/animales/buscar_animales/(:num)', 'Animales::buscar_animales/$1');
$routes->post('/animales/editar/(:num)', 'Animales::editar/$1');
$routes->delete('/animales/eliminar/(:num)','Animales::eliminar/$1');
//RUTAS API
$routes->get('/casahogar/v1/productos', 'ApiProductos::buscarProductos');
$routes->get('/casahogar/v1/productos(:num)', 'ApiProductos::buscarProducto/$1');

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
