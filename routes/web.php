<?php

use App\Http\Controllers\DropdownController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DropdownController::class)->group(function() {
    Route::get('dropdown', 'index');
    Route::post('fetch-states', 'fetchState')->name('state.post');
    Route::post('fetch-cities', 'fetchCity')->name('city.post');
});
