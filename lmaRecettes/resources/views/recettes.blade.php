<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="fetchGpt.js"></script>

    <title>LMA Recettes</title>
</head>

<body>
    <div class="container">
        <h1>Happy Recipie</h1>

        <div class="ingredients">
            @foreach ($ingredients as $ingredient)
                <li class="ingredient-{{ $ingredient->name }}" onclick="addIngredient(this)">
                    {{ $ingredient->name }}
                    <input type="checkbox" name="ingredients" value="{{ $ingredient->name }}"
                        {{ $ingredient->is_selected ? 'checked' : '' }}>
                </li>
            @endforeach
        </div>

        <label for="time">Temps de préparation :</label>
        <select name="time">
            <option value="0-30">0-30 minutes</option>
            <option value="30-60">30-60 minutes</option>
            <option value="60+">60 minutes et plus</option>
        </select>

        <label for="numberOfPeople">Nombre de personnes :</label>
        <input type="number" name="numberOfPeople" value="4" style="width:30px">

        <button type="button" onclick="getRecipe()">Générer ma recette</button>

        <div id="recipe"></div>
    </div>