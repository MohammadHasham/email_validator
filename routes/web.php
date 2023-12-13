<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailValidationController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/email-validation-form', [EmailValidationController::class, 'showForm'])->name('email.validation.form');
Route::post('/validate-email', [EmailValidationController::class, 'validateEmail'])->name('email.validation.validate');

