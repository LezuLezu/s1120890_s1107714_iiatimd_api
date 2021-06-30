<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoanController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'


], function ($router) {

    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('logoutall', [App\Http\Controllers\AuthController::class, 'logoutall']);

    // Custom routes
    // Show open loans
    Route::get('loans', [LoanController::class, 'indexOpen']);

    // Show loan by id
    Route::get('loans/{id}', [LoanController::class, "showLoan"]);

    // Show all loans
    Route::get('all-loans', [LoanController::class, 'indexAll']);

    // Show payed loans
    Route::get('payed', [LoanController::class, "indexPayed"]);

    // Add loan
    Route::post('add-loan', [LoanController::class, "storeLoan"]);

    Route::post("pay-loan/{id}", [LoanController::class, "updateLoan"]);
});



Route::any('{any}', function(){
    return response()->json([
    	'status' => 'error',
        'message' => 'Resource not found'], 404);
})->where('any', '.*');
