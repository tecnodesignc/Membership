<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/committee'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.committee.index',
        'uses' => 'CommitteeController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.committee.show',
        'uses' => 'CommitteeController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.committee.create',
        'uses' => 'CommitteeController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.committee.update',
        'uses' => 'CommitteeController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.committee.destroy',
        'uses' => 'CommitteeController@destroy',
        'middleware' => ['auth:api']
    ]);

});
