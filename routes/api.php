<?php

use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/partner', [UserController::class, 'index']);


Route::get('/public', function (Request $request) {
    return response()->json(
        [
            'success' => true,
             "message" => "Hello from a public endpoint! You don't need to be authenticated to see this."
        ],
        200
    );
});

Route::get('/private', function (Request $request) {
    return response()->json(
        [
            'success' => true,
            "message" => "OK Hello from a private endpoint! You need to have a valid access token to see this."
        ],
        200
    );
})->middleware('auth.jwt');

Route::get('/private-read', function (Request $request) {
    return response()->json([
        'success' => true,
        "message" => "OK Hello from a private endpoint! You can read:messages."
    ]);
})->middleware('auth.jwt.scope:read:messages');

Route::get('/private-write', function (Request $request) {
    return response()->json([
        'success' => true,
        "message" => "OK Hello from a private endpoint! You can write:messages."
    ]);
})->middleware('auth.jwt.scope:write:messages');

Route::get('/private-delete', function (Request $request) {
    return response()->json([
        'success' => true,
        "message" => "OK Hello from a private endpoint! You can delete:messages."
    ]);
})->middleware('auth.jwt.scope:delete:messages');
