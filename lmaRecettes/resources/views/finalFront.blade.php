<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="final.js" defer></script>
    <link rel="stylesheet" href="./final.css">
    <link rel="icon" type="image/png" href="logo_happy_recipe.webp" />

    <title>Happy Recipes</title>

</head>
<header>
    <nav>
        <a href="/">Acceuil</a>
        <a href="/recetteFR.html">Contact</a>
    </nav>
</header>
<div>

    <article>
        <h1>Happy Recipes</h1>
    </article>
    <article>
        <h2>Explorer une cuisine saine et écolo avec ce que vous avez sous la main<br> Transformer vos provisions en
            délices équilibrés et respectueux de l'environnement</h2>
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
                    <input type="number" id="numberOfPeople" name="numberOfPeople" value="4" style="width:30px">
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="number-select">
                    <label for="numberOfPeople">Nombre de personnes :</label>
                    <input type="number" id="numberOfPeople" name="numberOfPeople" value="4" style="width:30px">
                </div>
            </div>
        </div> --}}



    {{-- <div class="special-category">
            <div class="counter-container">
                <div class="special-category">
                    <div class="counter-container"> --}}
    <div class="category-list">
        <button class="category-button" id="newIngredient"><strong>ajout
                d'ingrédients</strong></button>
        <textarea class="text-box" placeholder="Entrez un ingrédient"></textarea>
        <button class="ajouter-button">Ajouter</button>
    </div>
    {{-- </div>
                </div>
            </div>
        </div> --}}
</div>

<div class="article">
    <h4>
        <button class="genere-button"><strong>génère-moi une recette</strong></button>
    </h4>
    <div id="recipe"></div>

    <div id="loading-screen">
        <div id="loading-container">
            <span id="loading-message"></span>
            <div id="dots" class="dots-animation"></div>
        </div>
    </div>
</div>


<footer>
    <div>
        <a href="#">À propos</a>
        <a href="#">Services</a>
        <a>&copy; 2023 Tous droits réservés. HappyRecipies.org</a>
        <div class="social-icons">
            <a href="https://www.instagram.com/" target="_blank"><img
                    src="https://img.freepik.com/vecteurs-premium/icone-application-instagram-logo-medias-sociaux-illustration-vectorielle_277909-403.jpg?w=2000"
                    alt="instagram"></a>
            <a href="https://twitter.com/" target="_blank"><img
                    src="https://assets-global.website-files.com/64760069e93084646c9ee428/64c2bb00cc53d81d58842318_og-twitter-x.png"
                    alt="Twitter"></a>

        </div>
    </div>


</footer>
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
        document.querySelectorAll(".container, .ingredients, #recipe, #loading-container").forEach(elem => {
            elem.classList.add("blur-element");
        });
    }

    function acceptCookies() {
        // Définir le cookie "acceptedCookies" avec une date d'expiration (par exemple, 365 jours)
        document.cookie = "acceptedCookies=true; expires=" + new Date(new Date().getTime() + 365 * 24 * 60 * 60 * 1000)
            .toUTCString();
        document.querySelectorAll(".container, .ingredients, #recipe, #loading-container").forEach(elem => {
            elem.classList.remove("blur-element");
        });

        // Cacher la fenêtre modale
        document.getElementById("cookie-modal").style.display = "none";
    }

    function rejectCookies() {
        // Cacher la fenêtre modale sans définir le cookie
        document.getElementById("cookie-modal").style.display = "none";
        document.querySelectorAll(".container, .ingredients, #recipe, #loading-container").forEach(elem => {
            elem.classList.remove("blur-element");
        });
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
