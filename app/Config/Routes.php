<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// my apis

$routes->post('practice', 'PracticeController::create');
$routes->get('practice', 'PracticeController::index');
$routes->get('practice/(:num)', 'PracticeController::show/$1');
$routes->put('practice/(:num)', 'PracticeController::update/$1');
$routes->post('practice/update/(:num)', 'PracticeController::update/$1');
$routes->delete('practice/(:num)', 'PracticeController::delete/$1');
