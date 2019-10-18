<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/profiles'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.profile.index',
        'uses' => 'ProfileController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.profile.show',
        'uses' => 'ProfileController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.profile.create',
        'uses' => 'ProfileController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.profile.update',
        'uses' => 'ProfileController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.profile.destroy',
        'uses' => 'ProfileController@destroy',
        'middleware' => ['auth:api']
    ]);

});
