<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GroupProjectController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/projects/review/{id}', [ProjectController::class, 'review_show'])->name('projects.review_show');
    Route::get('/projects/review', [ProjectController::class, 'review'])->name('projects.review');
    Route::resource('projects', ProjectController::class);

    Route::resource('groups', GroupController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('users', UsersController::class);
    Route::resource('group-projects', GroupProjectController::class);


    Route::get("media/download/{id}", [ProjectController::class, 'downloadMedia'])->name('media.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
