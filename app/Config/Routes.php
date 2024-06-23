<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'GalleryController::index');
$routes->get('create_view', 'GalleryController::create_view');
$routes->post('/create', 'GalleryController::create');
$routes->get('/delete/(:num)', 'GalleryController::delete/$1');
$routes->get('/update_view/(:num)', 'GalleryController::update_view/$1');
$routes->post('/update/(:num)', 'GalleryController::update/$1');
$routes->get('/download/(:any)', 'GalleryController::download/$1');
