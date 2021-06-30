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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

//Pay loan
Route::post("pay-loan/{id}", [LoanController::class, "updateLoan"]);
