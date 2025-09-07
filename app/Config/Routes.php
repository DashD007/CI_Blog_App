<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// blog routes 
$routes->group("blog", function($routes){
    $routes->get('(:num)', 'Blog\BlogController::get/$1'); // to get a single blog data
    $routes->get('create/view', 'Blog\BlogController::blogCreateView'); // to get the view for creating blog
    $routes->post('create', 'Blog\BlogController::create'); // to create the blog (backend)
    $routes->get('update/view/(:num)', 'Blog\BlogController::blogUpdateView/$1'); // to get the view for updating blog
    $routes->post('update/(:num)', 'Blog\BlogController::update/$1'); // to update the blog (backend)
    $routes->get('delete/(:num)', 'Blog\BlogController::delete/$1'); // to delete the blog (backend);
});

$routes->group("category",function($routes){
    $routes->get('', 'Category\CategoryController::categorymaster');
    $routes->get('create', 'Category\CategoryController::createView');
    $routes->post('create', 'Category\CategoryController::create');
    $routes->get('delete/(:num)', 'Category\CategoryController::delete/$1');
    $routes->get('update/(:num)', 'Category\CategoryController::updateView/$1');
    $routes->post('update/(:num)', 'Category\CategoryController::update/$1');
});

$routes->group("role",function($routes){
    $routes->get('', 'Role\RoleController::index');
    $routes->get('create', 'Role\RoleController::createView');
    $routes->post('create', 'Role\RoleController::create');

    $routes->get('delete/(:num)', 'Role\RoleController::delete/$1');
    $routes->get('update/(:num)', 'Role\RoleController::updateView/$1');
    $routes->post('update/(:num)', 'Role\RoleController::update/$1');
});

$routes->group('user',function($routes){
    $routes->get('', 'User\UserController::index');
    $routes->get('create', 'User\UserController::createView');
    $routes->post('create', 'User\UserController::create');
    $routes->get('update/(:num)', 'User\UserController::updateView/$1');
    $routes->post('update/(:num)', 'User\UserController::update/$1');
    $routes->get('delete/(:num)', 'User\UserController::delete/$1');
});


//comment routes
$routes->post('/comment/save/(:num)', 'BlogController::saveComment/$1');

service('auth')->routes($routes);