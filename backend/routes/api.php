<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\CustomerReceiptsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/v1')->group(function () {
    Route::resource('users', UsersController::class)->except('create', 'edit');
    Route::resource('customers', CustomersController::class)->except('create', 'edit');
    Route::resource('customer-receipts', CustomerReceiptsController::class)->except('create', 'edit');
});