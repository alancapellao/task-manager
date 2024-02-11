<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\MenuController;

require __DIR__ . '/auth.php';

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

Route::middleware('auth')->group(function () {

        Route::controller(UsersController::class)->group(function () {
                Route::get('/profile', 'index')->name('profile.index');
                Route::put('/profile', 'update')->name('profile.update');
        });

        Route::controller(SettingsController::class)->group(function () {
                Route::get('/settings', 'index')->name('settings.index');
                Route::put('/settings', 'update')->name('settings.update');
                Route::patch('/settings/theme', 'theme')->name('settings.theme');
        });

        Route::controller(TasksController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('dashboard');
                Route::get('/tasks/search', 'search')->name('tasks.search');
        });

        Route::resource('tasks', TasksController::class)->except(['index']);
        Route::resource('lists', ListsController::class);
        Route::resource('tags', TagsController::class);
        Route::resource('notes', NotesController::class);
        Route::resource('menu', MenuController::class)->only(['index']);
});
