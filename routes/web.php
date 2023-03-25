<?php

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/developers', [DeveloperController::class, 'index'])
    ->name('developers.index');

Route::get('/jobs', [JobController::class, 'index'])
    ->name('jobs.index');

Route::get('/jobs/reimport', [JobController::class, 'reImport'])
    ->name('jobs.re-import');

