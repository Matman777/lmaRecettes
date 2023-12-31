<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ProfileController;
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

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/conditions', function () {
    return view('conditions');
});

Route::get('/propos', function () {
    return view('propos');
});


Route::get('/recettes', [IngredientController::class, 'index']);


Route::get('/', [IngredientController::class, 'final']);

Route::get('/api-key', [ApiController::class, 'getApiKey']);

Route::get('/enregistrer-stats/{tag}/{param2}', [InfoController::class, 'enregistrerStats']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [InfoController::class, 'afficheGraphes']);
});

require __DIR__ . '/auth.php';
