<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/studies'], function (Router $router) {

    $router->get('/', [
        'as' =>'api.membership.study.index',
        'uses' => 'StudyController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.membership.study.show',
        'uses' => 'StudyController@show',
    ]);
    $router->post('/', [
        'as' => 'api.membership.study.create',
        'uses' => 'StudyController@create',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.membership.study.update',
        'uses' => 'StudyController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' =>'api.membership.study.destroy',
        'uses' => 'StudyController@destroy',
        'middleware' => ['auth:api']
    ]);

});
