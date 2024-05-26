<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', 'App\Modules\Auth\AuthController@login');

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/logout', 'App\Modules\Auth\AuthController@logout');

//    $modules = [
//        'Store',
//    ];
//
//    foreach ($modules as $module) {
//        require_once base_path("app\Modules\\$module\\routes.php");
//    }
});

/** @var  $api noinspection Php * */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group([
        'prefix' => 'v1',
        'middleware' => ['logApi', 'auth:sanctum'],
    ], function ($api) {
        $modules = [
            'Store',
            'Product',
        ];

        foreach ($modules as $module) {
            require_once base_path("app/Modules/{$module}/routes.php");
        }
    });
});

