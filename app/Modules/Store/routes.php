<?php



//Route::namespace('App\Modules\Store\Controllers')
//    ->prefix('store')
//    ->group(function ($api) {
//        Route::get('/', [
//            'uses' => 'StoreController@view',
//        ]);
//    });

$api->group([
    'prefix' => 'store',
    'namespace' => 'App\Modules\Store\Controllers'
], function ($api) {

    $api->get('/', [
        'uses' => 'StoreController@view',
    ]);

    $api->post('/', [
        'uses' => 'StoreController@create',
    ]);

    $api->get('/{id}', [
        'uses' => 'StoreController@show',
    ]);

    $api->put('/{id}', [
        'uses' => 'StoreController@update',
    ]);

    $api->delete('/{id}', [
        'uses' => 'StoreController@delete',
    ]);
});