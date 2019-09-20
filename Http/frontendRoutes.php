<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/membresia'], function (Router $router) {
    $router->group(['prefix' =>'/profesiones'], function (Router $router) {
        $router->bind('profession', function ($id) {
            return app('Modules\Membership\Repositories\ProfessionRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'membership.profession.index',
            'uses' => 'ProfessionController@index',
            'middleware' => 'can:membership.professions.index'
        ]);
        $router->get('create', [
            'as' => 'membership.profession.create',
            'uses' => 'ProfessionController@create',
            'middleware' => 'can:membership.professions.create'
        ]);
        $router->post('/', [
            'as' => 'membership.profession.store',
            'uses' => 'ProfessionController@store',
            'middleware' => 'can:membership.professions.create'
        ]);
        $router->get('{profession}/edit', [
            'as' => 'membership.profession.edit',
            'uses' => 'ProfessionController@edit',
            'middleware' => 'can:membership.professions.edit'
        ]);
        $router->put('{profession}', [
            'as' => 'membership.profession.update',
            'uses' => 'ProfessionController@update',
            'middleware' => 'can:membership.professions.edit'
        ]);
        $router->delete('{profession}', [
            'as' => 'membership.profession.destroy',
            'uses' => 'ProfessionController@destroy',
            'middleware' => 'can:membership.professions.destroy'
        ]);
    });
    $router->group(['prefix' =>'/distritos'], function (Router $router) {
        $router->bind('district', function ($id) {
            return app('Modules\Membership\Repositories\DistrictRepository')->find($id);
        });
        $router->get('districts', [
            'as' => 'membership.district.index',
            'uses' => 'DistrictController@index',
            'middleware' => 'can:membership.districts.index'
        ]);
        $router->get('districts/create', [
            'as' => 'membership.district.create',
            'uses' => 'DistrictController@create',
            'middleware' => 'can:membership.districts.create'
        ]);
        $router->post('districts', [
            'as' => 'membership.district.store',
            'uses' => 'DistrictController@store',
            'middleware' => 'can:membership.districts.create'
        ]);
        $router->get('districts/{district}/edit', [
            'as' => 'membership.district.edit',
            'uses' => 'DistrictController@edit',
            'middleware' => 'can:membership.districts.edit'
        ]);
        $router->put('districts/{district}', [
            'as' => 'membership.district.update',
            'uses' => 'DistrictController@update',
            'middleware' => 'can:membership.districts.edit'
        ]);
        $router->delete('districts/{district}', [
            'as' => 'membership.district.destroy',
            'uses' => 'DistrictController@destroy',
            'middleware' => 'can:membership.districts.destroy'
        ]);
    });
    $router->group(['prefix' =>'/congregaciones'], function (Router $router) {
        $router->bind('congregation', function ($id) {
            return app('Modules\Membership\Repositories\CongregationRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'membership.congregation.index',
            'uses' => 'CongregationController@index',
            'middleware' => 'can:membership.congregations.index'
        ]);
        $router->get('crear', [
            'as' => 'membership.congregation.create',
            'uses' => 'CongregationController@create',
            'middleware' => 'can:membership.congregations.create'
        ]);
        $router->post('/', [
            'as' => 'membership.congregation.store',
            'uses' => 'CongregationController@store',
            'middleware' => 'can:membership.congregations.create'
        ]);
        $router->get('{congregation}/editar', [
            'as' => 'membership.congregation.edit',
            'uses' => 'CongregationController@edit',
            'middleware' => 'can:membership.congregations.edit'
        ]);
        $router->put('/{congregation}', [
            'as' => 'membership.congregation.update',
            'uses' => 'CongregationController@update',
            'middleware' => 'can:membership.congregations.edit'
        ]);
        $router->delete('{congregation}', [
            'as' => 'membership.congregation.destroy',
            'uses' => 'CongregationController@destroy',
            'middleware' => 'can:membership.congregations.destroy'
        ]);
    });
    $router->bind('committee', function ($id) {
        return app('Modules\Membership\Repositories\CommitteeRepository')->find($id);
    });
    $router->get('committees', [
        'as' => 'membership.committee.index',
        'uses' => 'CommitteeController@index',
        'middleware' => 'can:membership.committees.index'
    ]);
    $router->get('committees/create', [
        'as' => 'membership.committee.create',
        'uses' => 'CommitteeController@create',
        'middleware' => 'can:membership.committees.create'
    ]);
    $router->post('committees', [
        'as' => 'membership.committee.store',
        'uses' => 'CommitteeController@store',
        'middleware' => 'can:membership.committees.create'
    ]);
    $router->get('committees/{committee}/edit', [
        'as' => 'membership.committee.edit',
        'uses' => 'CommitteeController@edit',
        'middleware' => 'can:membership.committees.edit'
    ]);
    $router->put('committees/{committee}', [
        'as' => 'membership.committee.update',
        'uses' => 'CommitteeController@update',
        'middleware' => 'can:membership.committees.edit'
    ]);
    $router->delete('committees/{committee}', [
        'as' => 'membership.committee.destroy',
        'uses' => 'CommitteeController@destroy',
        'middleware' => 'can:membership.committees.destroy'
    ]);
    $router->bind('workstation', function ($id) {
        return app('Modules\Membership\Repositories\WorkstationRepository')->find($id);
    });
    $router->get('workstations', [
        'as' => 'membership.workstation.index',
        'uses' => 'WorkstationController@index',
        'middleware' => 'can:membership.workstations.index'
    ]);
    $router->get('workstations/create', [
        'as' => 'membership.workstation.create',
        'uses' => 'WorkstationController@create',
        'middleware' => 'can:membership.workstations.create'
    ]);
    $router->post('workstations', [
        'as' => 'membership.workstation.store',
        'uses' => 'WorkstationController@store',
        'middleware' => 'can:membership.workstations.create'
    ]);
    $router->get('workstations/{workstation}/edit', [
        'as' => 'membership.workstation.edit',
        'uses' => 'WorkstationController@edit',
        'middleware' => 'can:membership.workstations.edit'
    ]);
    $router->put('workstations/{workstation}', [
        'as' => 'membership.workstation.update',
        'uses' => 'WorkstationController@update',
        'middleware' => 'can:membership.workstations.edit'
    ]);
    $router->delete('workstations/{workstation}', [
        'as' => 'membership.workstation.destroy',
        'uses' => 'WorkstationController@destroy',
        'middleware' => 'can:membership.workstations.destroy'
    ]);
    $router->bind('profile', function ($id) {
        return app('Modules\Membership\Repositories\ProfileRepository')->find($id);
    });
    $router->get('profiles', [
        'as' => 'membership.profile.index',
        'uses' => 'ProfileController@index',
        'middleware' => 'can:membership.profiles.index'
    ]);
    $router->get('profiles/create', [
        'as' => 'membership.profile.create',
        'uses' => 'ProfileController@create',
        'middleware' => 'can:membership.profiles.create'
    ]);
    $router->post('profiles', [
        'as' => 'membership.profile.store',
        'uses' => 'ProfileController@store',
        'middleware' => 'can:membership.profiles.create'
    ]);
    $router->get('profiles/{profile}/edit', [
        'as' => 'membership.profile.edit',
        'uses' => 'ProfileController@edit',
        'middleware' => 'can:membership.profiles.edit'
    ]);
    $router->put('profiles/{profile}', [
        'as' => 'membership.profile.update',
        'uses' => 'ProfileController@update',
        'middleware' => 'can:membership.profiles.edit'
    ]);
    $router->delete('profiles/{profile}', [
        'as' => 'membership.profile.destroy',
        'uses' => 'ProfileController@destroy',
        'middleware' => 'can:membership.profiles.destroy'
    ]);
    $router->bind('address', function ($id) {
        return app('Modules\Membership\Repositories\AddressRepository')->find($id);
    });
    $router->get('addresses', [
        'as' => 'membership.address.index',
        'uses' => 'AddressController@index',
        'middleware' => 'can:membership.addresses.index'
    ]);
    $router->get('addresses/create', [
        'as' => 'membership.address.create',
        'uses' => 'AddressController@create',
        'middleware' => 'can:membership.addresses.create'
    ]);
    $router->post('addresses', [
        'as' => 'membership.address.store',
        'uses' => 'AddressController@store',
        'middleware' => 'can:membership.addresses.create'
    ]);
    $router->get('addresses/{address}/edit', [
        'as' => 'membership.address.edit',
        'uses' => 'AddressController@edit',
        'middleware' => 'can:membership.addresses.edit'
    ]);
    $router->put('addresses/{address}', [
        'as' => 'membership.address.update',
        'uses' => 'AddressController@update',
        'middleware' => 'can:membership.addresses.edit'
    ]);
    $router->delete('addresses/{address}', [
        'as' => 'membership.address.destroy',
        'uses' => 'AddressController@destroy',
        'middleware' => 'can:membership.addresses.destroy'
    ]);
// append







});
