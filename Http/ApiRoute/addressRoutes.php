<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/address'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.address.index',
        'uses' => 'AddressController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.address.show',
        'uses' => 'AddressController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.address.create',
        'uses' => 'AddressController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.address.update',
        'uses' => 'AddressController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.address.delete',
        'uses' => 'AddressController@delete',
        'middleware' => ['auth:api']
    ]);

});
