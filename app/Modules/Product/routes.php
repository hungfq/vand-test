<?php

$api->group([
    'prefix' => 'product',
    'namespace' => 'App\Modules\Product\Controllers'
], function ($api) {

    $api->get('/', [
        'uses' => 'ProductController@view',
    ]);

    $api->post('/', [
        'uses' => 'ProductController@create',
    ]);

    $api->get('/{id}', [
        'uses' => 'ProductController@show',
    ]);

    $api->put('/{id}', [
        'uses' => 'ProductController@update',
    ]);

    $api->delete('/{id}', [
        'uses' => 'ProductController@delete',
    ]);

});