<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/congregation'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.congregation.index',
        'uses' => 'CongregationController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.congregation.show',
        'uses' => 'CongregationController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.congregation.create',
        'uses' => 'CongregationController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.congregation.update',
        'uses' => 'CongregationController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.congregation.destroy',
        'uses' => 'CongregationController@destroy',
        'middleware' => ['auth:api']
    ]);

});
