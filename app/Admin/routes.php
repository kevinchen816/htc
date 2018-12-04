<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->get('users', 'UsersController@index');

    $router->get('plans', 'PlansController@index');
    // $router->get('plans/{id}', 'PlansController@show');
    $router->get('plans/create', 'PlansController@create');
    $router->post('plans', 'PlansController@store');
    $router->get('plans/{id}/edit', 'PlansController@edit');
    $router->put('plans/{id}', 'PlansController@update');

    /* Plan Products */
    $router->get('plan/products', 'PlanProductsController@index');
    $router->get('plan/products/create', 'PlanProductsController@create');
    $router->post('plan/products', 'PlanProductsController@store');
    $router->get('plan/products/{id}/edit', 'PlanProductsController@edit');
    $router->put('plan/products/{id}', 'PlanProductsController@update');

    /* for test */
    $router->get('plan/products/build', 'PlanProductsController@build');
    $router->get('plan/products/test1', 'PlanProductsController@test1');
    $router->get('plan/products/test2', 'PlanProductsController@test2');
    $router->get('plan/products/test3', 'PlanProductsController@test3');

});
