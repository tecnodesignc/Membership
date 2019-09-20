<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/membership'], function (Router $router) {
    $router->bind('profession', function ($id) {
        return app('Modules\Membership\Repositories\ProfessionRepository')->find($id);
    });
    $router->get('professions', [
        'as' => 'admin.membership.profession.index',
        'uses' => 'ProfessionController@index',
        'middleware' => 'can:membership.professions.index'
    ]);
    $router->get('professions/create', [
        'as' => 'admin.membership.profession.create',
        'uses' => 'ProfessionController@create',
        'middleware' => 'can:membership.professions.create'
    ]);
    $router->post('professions', [
        'as' => 'admin.membership.profession.store',
        'uses' => 'ProfessionController@store',
        'middleware' => 'can:membership.professions.create'
    ]);
    $router->get('professions/{profession}/edit', [
        'as' => 'admin.membership.profession.edit',
        'uses' => 'ProfessionController@edit',
        'middleware' => 'can:membership.professions.edit'
    ]);
    $router->put('professions/{profession}', [
        'as' => 'admin.membership.profession.update',
        'uses' => 'ProfessionController@update',
        'middleware' => 'can:membership.professions.edit'
    ]);
    $router->delete('professions/{profession}', [
        'as' => 'admin.membership.profession.destroy',
        'uses' => 'ProfessionController@destroy',
        'middleware' => 'can:membership.professions.destroy'
    ]);
    $router->bind('district', function ($id) {
        return app('Modules\Membership\Repositories\DistrictRepository')->find($id);
    });
    $router->get('districts', [
        'as' => 'admin.membership.district.index',
        'uses' => 'DistrictController@index',
        'middleware' => 'can:membership.districts.index'
    ]);
    $router->get('districts/create', [
        'as' => 'admin.membership.district.create',
        'uses' => 'DistrictController@create',
        'middleware' => 'can:membership.districts.create'
    ]);
    $router->post('districts', [
        'as' => 'admin.membership.district.store',
        'uses' => 'DistrictController@store',
        'middleware' => 'can:membership.districts.create'
    ]);
    $router->get('districts/{district}/edit', [
        'as' => 'admin.membership.district.edit',
        'uses' => 'DistrictController@edit',
        'middleware' => 'can:membership.districts.edit'
    ]);
    $router->put('districts/{district}', [
        'as' => 'admin.membership.district.update',
        'uses' => 'DistrictController@update',
        'middleware' => 'can:membership.districts.edit'
    ]);
    $router->delete('districts/{district}', [
        'as' => 'admin.membership.district.destroy',
        'uses' => 'DistrictController@destroy',
        'middleware' => 'can:membership.districts.destroy'
    ]);
    $router->bind('congregation', function ($id) {
        return app('Modules\Membership\Repositories\CongregationRepository')->find($id);
    });
    $router->get('congregations', [
        'as' => 'admin.membership.congregation.index',
        'uses' => 'CongregationController@index',
        'middleware' => 'can:membership.congregations.index'
    ]);
    $router->get('congregations/create', [
        'as' => 'admin.membership.congregation.create',
        'uses' => 'CongregationController@create',
        'middleware' => 'can:membership.congregations.create'
    ]);
    $router->post('congregations', [
        'as' => 'admin.membership.congregation.store',
        'uses' => 'CongregationController@store',
        'middleware' => 'can:membership.congregations.create'
    ]);
    $router->get('congregations/{congregation}/edit', [
        'as' => 'admin.membership.congregation.edit',
        'uses' => 'CongregationController@edit',
        'middleware' => 'can:membership.congregations.edit'
    ]);
    $router->put('congregations/{congregation}', [
        'as' => 'admin.membership.congregation.update',
        'uses' => 'CongregationController@update',
        'middleware' => 'can:membership.congregations.edit'
    ]);
    $router->delete('congregations/{congregation}', [
        'as' => 'admin.membership.congregation.destroy',
        'uses' => 'CongregationController@destroy',
        'middleware' => 'can:membership.congregations.destroy'
    ]);
    $router->bind('committee', function ($id) {
        return app('Modules\Membership\Repositories\CommitteeRepository')->find($id);
    });
    $router->get('committees', [
        'as' => 'admin.membership.committee.index',
        'uses' => 'CommitteeController@index',
        'middleware' => 'can:membership.committees.index'
    ]);
    $router->get('committees/create', [
        'as' => 'admin.membership.committee.create',
        'uses' => 'CommitteeController@create',
        'middleware' => 'can:membership.committees.create'
    ]);
    $router->post('committees', [
        'as' => 'admin.membership.committee.store',
        'uses' => 'CommitteeController@store',
        'middleware' => 'can:membership.committees.create'
    ]);
    $router->get('committees/{committee}/edit', [
        'as' => 'admin.membership.committee.edit',
        'uses' => 'CommitteeController@edit',
        'middleware' => 'can:membership.committees.edit'
    ]);
    $router->put('committees/{committee}', [
        'as' => 'admin.membership.committee.update',
        'uses' => 'CommitteeController@update',
        'middleware' => 'can:membership.committees.edit'
    ]);
    $router->delete('committees/{committee}', [
        'as' => 'admin.membership.committee.destroy',
        'uses' => 'CommitteeController@destroy',
        'middleware' => 'can:membership.committees.destroy'
    ]);
    $router->bind('workstation', function ($id) {
        return app('Modules\Membership\Repositories\WorkstationRepository')->find($id);
    });
    $router->get('workstations', [
        'as' => 'admin.membership.workstation.index',
        'uses' => 'WorkstationController@index',
        'middleware' => 'can:membership.workstations.index'
    ]);
    $router->get('workstations/create', [
        'as' => 'admin.membership.workstation.create',
        'uses' => 'WorkstationController@create',
        'middleware' => 'can:membership.workstations.create'
    ]);
    $router->post('workstations', [
        'as' => 'admin.membership.workstation.store',
        'uses' => 'WorkstationController@store',
        'middleware' => 'can:membership.workstations.create'
    ]);
    $router->get('workstations/{workstation}/edit', [
        'as' => 'admin.membership.workstation.edit',
        'uses' => 'WorkstationController@edit',
        'middleware' => 'can:membership.workstations.edit'
    ]);
    $router->put('workstations/{workstation}', [
        'as' => 'admin.membership.workstation.update',
        'uses' => 'WorkstationController@update',
        'middleware' => 'can:membership.workstations.edit'
    ]);
    $router->delete('workstations/{workstation}', [
        'as' => 'admin.membership.workstation.destroy',
        'uses' => 'WorkstationController@destroy',
        'middleware' => 'can:membership.workstations.destroy'
    ]);
    $router->bind('profile', function ($id) {
        return app('Modules\Membership\Repositories\ProfileRepository')->find($id);
    });
    $router->get('profiles', [
        'as' => 'admin.membership.profile.index',
        'uses' => 'ProfileController@index',
        'middleware' => 'can:membership.profiles.index'
    ]);
    $router->get('profiles/create', [
        'as' => 'admin.membership.profile.create',
        'uses' => 'ProfileController@create',
        'middleware' => 'can:membership.profiles.create'
    ]);
    $router->post('profiles', [
        'as' => 'admin.membership.profile.store',
        'uses' => 'ProfileController@store',
        'middleware' => 'can:membership.profiles.create'
    ]);
    $router->get('profiles/{profile}/edit', [
        'as' => 'admin.membership.profile.edit',
        'uses' => 'ProfileController@edit',
        'middleware' => 'can:membership.profiles.edit'
    ]);
    $router->put('profiles/{profile}', [
        'as' => 'admin.membership.profile.update',
        'uses' => 'ProfileController@update',
        'middleware' => 'can:membership.profiles.edit'
    ]);
    $router->delete('profiles/{profile}', [
        'as' => 'admin.membership.profile.destroy',
        'uses' => 'ProfileController@destroy',
        'middleware' => 'can:membership.profiles.destroy'
    ]);
    $router->bind('address', function ($id) {
        return app('Modules\Membership\Repositories\AddressRepository')->find($id);
    });
    $router->get('addresses', [
        'as' => 'admin.membership.address.index',
        'uses' => 'AddressController@index',
        'middleware' => 'can:membership.addresses.index'
    ]);
    $router->get('addresses/create', [
        'as' => 'admin.membership.address.create',
        'uses' => 'AddressController@create',
        'middleware' => 'can:membership.addresses.create'
    ]);
    $router->post('addresses', [
        'as' => 'admin.membership.address.store',
        'uses' => 'AddressController@store',
        'middleware' => 'can:membership.addresses.create'
    ]);
    $router->get('addresses/{address}/edit', [
        'as' => 'admin.membership.address.edit',
        'uses' => 'AddressController@edit',
        'middleware' => 'can:membership.addresses.edit'
    ]);
    $router->put('addresses/{address}', [
        'as' => 'admin.membership.address.update',
        'uses' => 'AddressController@update',
        'middleware' => 'can:membership.addresses.edit'
    ]);
    $router->delete('addresses/{address}', [
        'as' => 'admin.membership.address.destroy',
        'uses' => 'AddressController@destroy',
        'middleware' => 'can:membership.addresses.destroy'
    ]);
// append







});
