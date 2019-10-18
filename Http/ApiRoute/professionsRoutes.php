<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/Professions'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.profession.index',
        'uses' => 'ProfessionController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.profession.show',
        'uses' => 'ProfessionController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.profession.create',
        'uses' => 'ProfessionController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.profession.update',
        'uses' => 'ProfessionController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.profession.destroy',
        'uses' => 'ProfessionController@destroy',
        'middleware' => ['auth:api']
    ]);

});
