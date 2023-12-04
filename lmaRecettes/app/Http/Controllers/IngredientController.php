<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function Index()
    {
        $ingredients = Ingredient::all();
        return view("/recettes", ["ingredients"  => $ingredients]);
    }
}
