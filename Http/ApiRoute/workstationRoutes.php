<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/wordstations'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.wordstation.index',
        'uses' => 'WordstationController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.wordstation.show',
        'uses' => 'WordstationController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.wordstation.create',
        'uses' => 'WordstationController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.wordstation.update',
        'uses' => 'WordstationController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.wordstation.destroy',
        'uses' => 'WordstationController@destroy',
        'middleware' => ['auth:api']
    ]);

});
