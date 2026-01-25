<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Utama::index');
$routes->get('/package-filter/(:any)', 'Utama::packageFilter/$1');

