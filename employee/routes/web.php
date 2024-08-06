<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Jobs\TestJob;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('customers/data', [CustomerController::class, 'getCustomers'])->name('customers.data');
    Route::resource('customer', CustomerController::class);



    // For testing only
    Route::get('/dispatch-job', function () {
        TestJob::dispatch();
        return 'Job dispatched!';
    });
});

Route::fallback(function () {
    return view('nonlogin.notfound');
});
