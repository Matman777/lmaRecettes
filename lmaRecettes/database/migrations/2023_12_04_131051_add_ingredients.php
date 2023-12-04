<?php

use App\Http\Controllers\IngredientController;
use App\Models\Ingredient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $ingredients = [
            'Poulet',
            'Herbes de Provence',
            'Pâtes',
            'Pommes',
            'Lait',
            'Sucre',
            'Pommes de terre',
            'Poisson',
            'Beurre',
            'Viande rouge',
            'Oeufs',
            'Tomates',
            'Gruyère',
            'Salade',
            'Bananes',
            'Farine',
            'Haricots verts',
            'Riz',
            'Chocolat',
            'Lentilles'
        ];

        foreach ($ingredients as $ingredientName) {
            $ingredient = new Ingredient();
            $ingredient->name = $ingredientName;
            $ingredient->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
