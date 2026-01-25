<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Utama::index');
$routes->get('/package-filter/(:any)', 'Utama::packageFilter/$1');

$routes->get('/admin', 'Admin::index');
$routes->get('/admin/login', 'Admin::login');
$routes->post('/admin/auth', 'Admin::auth');
$routes->get('/admin/logout', 'Admin::logout');
$routes->get('/admin/edit/(:any)', 'Admin::edit/$1');
$routes->post('/admin/update/(:any)', 'Admin::update/$1');
$routes->get('/admin/delete/(:any)', 'Admin::delete/$1');
