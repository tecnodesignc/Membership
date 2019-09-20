<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/profiles'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.profile.index',
        'uses' => 'EntityController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.profile.show',
        'uses' => 'EntityController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.profile.create',
        'uses' => 'EntityController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.profile.update',
        'uses' => 'EntityController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.profile.destroy',
        'uses' => 'EntityController@destroy',
        'middleware' => ['auth:api']
    ]);

});
