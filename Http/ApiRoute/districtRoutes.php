<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/distric'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.distric.index',
        'uses' => 'DistricController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.distric.show',
        'uses' => 'DistricController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.distric.create',
        'uses' => 'DistricController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.distric.update',
        'uses' => 'DistricController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.distric.destroy',
        'uses' => 'DistricController@destroy',
        'middleware' => ['auth:api']
    ]);

});
