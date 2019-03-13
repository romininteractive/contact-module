<?php

$router->group(['prefix' => '/contact'],
function($router){
	$router->resource('contacts', 'ContactsController')->only(['index', 'show','store']);
});

Route::post('contact', [
    'uses' => 'ContactsController@store',
    'as' => 'api.contact.contacts.store',
]);

