<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Settings\AccountController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth', 'verified'])->controller(ContactController::class)->prefix('contacts')->group( function () {
    Route::get('/', 'index')->name('contacts.index');
    Route::post('/', 'store')->name('contacts.store');
    Route::get('/create', 'create')->name('contacts.create');
    Route::get('/{contact:id}', 'show')->whereNumber('id')->name('contacts.show');
    Route::put('/{contact:id}', 'update')->whereNumber('id')->name('contacts.update');
    Route::get('/{contact:id}/edit', 'edit')->whereNumber('id')->name('contacts.edit');
    Route::delete('/{contact:id}', 'destroy')->whereNumber('id')->name('contacts.destroy');
});

Route::get('/settings/account', [AccountController::class, 'index']);

Auth::routes(['verify' => true]);

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
