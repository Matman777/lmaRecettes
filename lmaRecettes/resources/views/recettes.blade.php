<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./app.css">

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
        <select name="time" id="time">
            <option value="0-30">0-30 minutes</option>
            <option value="30-60">30-60 minutes</option>
            <option value="60+">60 minutes et plus</option>
        </select>

        <label for="numberOfPeople">Nombre de personnes :</label>
        <input type="number" id="numberOfPeople" name="numberOfPeople" value="4" style="width:30px">

        <div id="recipe"></div>
        <div id="loading-container">
            <span id="loading-message"></span>
            <div id="dots" class="dots-animation"></div>
        </div>

        <button type="button" onclick="clearIngredients()">Vider la liste d'ingrédients et/ou effacer la
            recette</button>

        <!-- Ajoutez ceci à l'endroit où vous souhaitez afficher le champ de saisie -->
        <input type="text" id="newIngredient" placeholder="Nouvel ingrédient">
        <button type="button" onclick="addCustomIngredient()">Ajouter</button>


        <button type="button" onclick="getRecipe()">Générer ma recette</button>

        <div id="cookie-modal">
            <p>Nous utilisons des cookies pour améliorer votre expérience sur notre site. Nous stockerons les heures de
                connexion, les ingrédients sélectionnés et les adresse IP. Acceptez-vous l'utilisation
                des cookies?</p>
            <button onclick="acceptCookies()">Oui</button>
            <button onclick="rejectCookies()">Non</button>
        </div>

        <script>
            // Vérifier si le cookie "acceptedCookies" est défini
            if (!getCookie("acceptedCookies")) {
                // Afficher la fenêtre modale si le cookie n'est pas défini
                document.getElementById("cookie-modal").style.display = "block";
            }

            function acceptCookies() {
                // Définir le cookie "acceptedCookies" avec une date d'expiration (par exemple, 365 jours)
                document.cookie = "acceptedCookies=true; expires=" + new Date(new Date().getTime() + 365 * 24 * 60 * 60 * 1000)
                    .toUTCString();

                // Cacher la fenêtre modale
                document.getElementById("cookie-modal").style.display = "none";
            }

            function rejectCookies() {
                // Cacher la fenêtre modale sans définir le cookie
                document.getElementById("cookie-modal").style.display = "none";
            }

            // Fonction pour récupérer la valeur d'un cookie par son nom
            function getCookie(name) {
                const cookies = document.cookie.split(";").map(cookie => cookie.trim());
                for (const cookie of cookies) {
                    const [cookieName, cookieValue] = cookie.split("=");
                    if (cookieName === name) {
                        return cookieValue;
                    }
                }
                return null;
            }
        </script>
        <script src="fetchGpt.js"></script>


    </div>
</body>

</html>
