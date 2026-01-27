<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Utama::index');
$routes->get('/package-filter/(:any)', 'Utama::packageFilter/$1');

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('status/(:num)', 'Admin::index/$1');
    $routes->get('create', 'Admin::create');
    $routes->post('store', 'Admin::store');
    $routes->get('edit/(:any)', 'Admin::edit/$1');
    $routes->post('update/(:any)', 'Admin::update/$1');
    $routes->get('delete/(:any)', 'Admin::delete/$1');
    $routes->get('logout', 'Admin::logout');
});

// Authentication Routes (No Filter)
$routes->get('/admin/login', 'Admin::login');
$routes->post('/admin/auth', 'Admin::auth');
$routes->get('/page/(:any)', 'Page::index/$1');
