<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Tasks
Route::get('/', [TaskController::class, 'index'])
    ->name('tasks')
    ->middleware('auth');

Route::get('tasks/create', [TaskController::class, 'create'])
    ->name('tasks.create')
    ->middleware('auth');

Route::post('tasks', [TaskController::class, 'store'])
    ->name('tasks.store')
    ->middleware('auth');

Route::get('tasks/{tasks}/edit', [TaskController::class, 'edit'])
    ->name('tasks.edit')
    ->middleware('auth');

Route::put('tasks/{tasks}', [TaskController::class, 'update'])
    ->name('tasks.update')
    ->middleware('auth');

Route::delete('tasks/{tasks}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy')
    ->middleware('auth');
