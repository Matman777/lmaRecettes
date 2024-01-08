<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="final.js" defer></script>
    <script src="infosPage.js" defer></script>
    <link rel="stylesheet" href="./final.css">
    <link rel="icon" type="image/png" href="logo_happy_recipe.webp" />

    <script>
        var idUser = "<?php echo bin2hex(random_bytes(16)); ?>";
    </script>

    <title>Happy Recipes</title>

</head>

<body>
    <header>
        <nav>
            <a href="/">Accueil</a>
            <a href="/contact">Contact</a>
        </nav>
    </header>
    <div class="main-content" id="main-content">
        <div>

            <article>
                <h1>Happy Recipes</h1>
            </article>
            <article>
                <h2>Explorez une cuisine écolo avec ce que vous avez sous la main:<br> Sélectionnez,
                    générez et dégustez!</h2>
            </article>



            <div class="category-container">
                @foreach ($categories as $categoryName => $categoryIngredients)
                    <div class="category">
                        <h3>{{ $categoryName }}</h3>
                        <div class="ingredients">
                            @foreach ($ingredients as $ingredient)
                                @if (in_array($ingredient->name, $categoryIngredients))
                                    <button class="custom-button">
                                        @if (array_key_exists($ingredient->name, $images))
                                            <img src="{{ $images[$ingredient->name] }}" alt="{{ $ingredient->name }}">
                                        @endif
                                        <span>{{ $ingredient->name }}</span>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>




            <div class="category-container">
                <div class="special-category">
                    <div class="category-list">
                        <div class="time-select">
                            <label for="time">Temps de préparation :</label>
                            <select name="time" id="time">
                                <option value="0-30">0-30 minutes</option>
                                <option value="30-60">30-60 minutes</option>
                                <option value="60+">60 minutes et plus</option>
                            </select>
                        </div>


                        <div class="number-select">
                            <label for="numberOfPeople">Nombre de personnes :</label>
                            <input type="number" id="numberOfPeople" name="numberOfPeople" value="4"
                                style="width:30px">
                        </div>
                    </div>
                </div>
            </div>



            <div class="ingredient-addition-container">
                <div class="category-list">
                    <button class="category-button" id="newIngredient">Ajout
                        d'ingrédients: </button>
                    <input class="text-box" placeholder="Entrez un ingrédient">
                    <button class="ajouter-button">Ajouter</button>
                </div>
            </div>

        </div>

        <div class="article">
            <h4>
                <button class="genere-button"><strong>Génère-moi une recette</strong></button>
            </h4>

            <div id="selected-ingredients"></div>

            <div id="recipe"></div>



            <div id="loading-screen">
                <div id="loading-container">
                    <span id="loading-message"></span>
                    <div id="dots" class="dots-animation"></div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="liens">
            <a href="propos">À propos</a>
            <a href="conditions">Conditions générales</a>
            <span>&copy; 2023 Tous droits réservés. HappyRecipes.org</span>
        </div>
    </footer>


    <div id="cookie-modal">
        <p><strong>Ce site web utilise des cookies</strong><br> <br>Les cookies nous permettent de personnaliser le
            contenu, les annonces et
            d'analyser notre trafic.
            Acceptez-vous les cookies?
        </p>
        <button class="accept" onclick="acceptCookies()">Oui</button>
        <button class="reject" onclick="rejectCookies()">Non</button>
    </div>
    <div id = "background-blur-overlay">
        < /div>
            <script>
                // Vérifier si le cookie "acceptedCookies" est défini
                // if (!getCookie("acceptedCookies")) {
                //     // Afficher la fenêtre modale si le cookie n'est pas défini
                //     document.getElementById("cookie-modal").style.display = "block";
                //     document.querySelectorAll(".container, .ingredients, #recipe, #loading-container").forEach(elem => {
                //         elem.classList.add("blur-element");
                //     });
                // }

                if (!getCookie("acceptedCookies")) {
                    document.getElementById("cookie-modal").style.display = "block";
                    document.getElementById("background-blur-overlay").style.display = "block"; // Appliquer au body
                }

                function acceptCookies() {
                    document.cookie = "acceptedCookies=true; expires=" + new Date(new Date().getTime() + 365 * 24 * 60 * 60 * 1000)
                        .toUTCString();
                    document.getElementById("background-blur-overlay").style.display =
                        "none"; // Retirer la classe de flou // Retirer du body
                    document.getElementById("cookie-modal").style.display = "none";
                }

                function rejectCookies() {
                    document.getElementById("cookie-modal").style.display = "none";
                    document.getElementById("background-blur-overlay").style.display = "none"; // Retirer du body
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
    </div>
</body>

</html>
