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
        'as' => 'admin.contact.contacts.create',
        'uses' => 'ContactController@create',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->post('contacts', [
        'as' => 'admin.contact.contacts.store',
        'uses' => 'ContactController@store',
        'middleware' => 'can:contact.contacts.create'
    ]);
    $router->get('contacts/{contact}/edit', [
        'as' => 'admin.contact.contacts.edit',
        'uses' => 'ContactController@edit',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->put('contacts/{contact}', [
        'as' => 'admin.contact.contacts.update',
        'uses' => 'ContactController@update',
        'middleware' => 'can:contact.contacts.edit'
    ]);
    $router->delete('contacts/{contact}', [
        'as' => 'admin.contact.contacts.destroy',
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

    Route::get('import', [
        'as'=> 'admin.contact.import',
        'uses' => 'ContactController@importContact']);
    Route::post('postimport', [
        'as'   => 'admin.contact.postimport',
        'uses' => 'ContactController@postImportContact']);

// append


});
