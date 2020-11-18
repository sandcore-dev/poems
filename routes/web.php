<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PoemController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('authenticate');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::post('/logout', [AuthController::class, 'confirmed'])
    ->name('confirmed');

Route::middleware('auth:sanctum')
    ->as('dashboard.')
    ->prefix('/dashboard')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('index');

        Route::resource('/author', AuthorController::class)
            ->except(['show', 'destroy']);

        Route::resource('/author/{author:id}/poem', PoemController::class)
            ->except(['destroy']);
    });
