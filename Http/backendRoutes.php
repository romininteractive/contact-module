<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/contact'], function (Router $router) {
    $router->bind('contact', function ($id) {
        return app('Modules\Contact\Repositories\ContactRepository')->find($id);
    });
    $router->get('contacts', [
        'as' => 'admin.contact.contact.index',
        'uses' => 'ContactController@index',
        'middleware' => 'can:contact.contacts.index'
    ]);
    $router->get('contacts/create', [
        'as' => 'admin.contact.contact.create',
        'uses' => 'ContactController@create',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->post('contacts', [
        'as' => 'admin.contact.contact.store',
        'uses' => 'ContactController@store',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->get('contacts/{contact}/edit', [
        'as' => 'admin.contact.contact.edit',
        'uses' => 'ContactController@edit',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->put('contacts/{contact}', [
        'as' => 'admin.contact.contact.update',
        'uses' => 'ContactController@update',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->delete('contacts/{contact}', [
        'as' => 'admin.contact.contact.destroy',
        'uses' => 'ContactController@destroy',
        'middleware' => 'can:contact.contacts.destroy'
    ]);
    $router->bind('contactaddress', function ($id) {
        return app('Modules\Contact\Repositories\ContactAddressRepository')->find($id);
    });
    $router->get('contactaddresses', [
        'as' => 'admin.contact.contactaddress.index',
        'uses' => 'ContactAddressController@index',
        'middleware' => 'can:contact.contactaddresses.index'
    ]);
    $router->get('contactaddresses/create', [
        'as' => 'admin.contact.contactaddress.create',
        'uses' => 'ContactAddressController@create',
        'middleware' => 'can:contact.contactaddresses.create'
    ]);
    $router->post('contactaddresses', [
        'as' => 'admin.contact.contactaddress.store',
        'uses' => 'ContactAddressController@store',
        'middleware' => 'can:contact.contactaddresses.create'
    ]);
    $router->get('contactaddresses/{contactaddress}/edit', [
        'as' => 'admin.contact.contactaddress.edit',
        'uses' => 'ContactAddressController@edit',
        'middleware' => 'can:contact.contactaddresses.edit'
    ]);
    $router->put('contactaddresses/{contactaddress}', [
        'as' => 'admin.contact.contactaddress.update',
        'uses' => 'ContactAddressController@update',
        'middleware' => 'can:contact.contactaddresses.edit'
    ]);
    $router->delete('contactaddresses/{contactaddress}', [
        'as' => 'admin.contact.contactaddress.destroy',
        'uses' => 'ContactAddressController@destroy',
        'middleware' => 'can:contact.contactaddresses.destroy'
    ]);
// append


});
