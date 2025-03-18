<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', [Controllers\DefaultController::class, 'index'])->name('welcome');
Route::get('/about', [Controllers\DefaultController::class, 'about'])->name('about');
Route::get('/contact', [Controllers\DefaultController::class, 'contact'])->name('contact');
Route::get('/menu', [Controllers\DefaultController::class, 'menu'])->name('menu');
Route::get('/menu/{slug}', [Controllers\MenuController::class, 'show'])->name('menu.detail');
Route::get('/plate/{plate}', [Controllers\PlateController::class, 'show'])->name('plate.detail');

Route::get('/blog', [Controllers\DefaultController::class, 'blog'])->name('blog');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
