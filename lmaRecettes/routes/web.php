<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\IngredientController;

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


//Route::get('/', [IngredientController::class, 'index']);

//Route::get('/', [InfoController::class, 'Graphe_ingredient']);

//Route::get('/', [InfoController::class, 'graphe_user']);

//Route::get('/', [InfoController::class, 'graphe3']);

Route::get('/', [InfoController::class, 'graphe_state_journaliere']);