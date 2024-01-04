<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="contact.css" type="text/css" rel="stylesheet">
    <script src="recettesFR.js" defer></script>
    <title>Happy Recipies</title>

</head>

<body>
    <header>
        <nav>
            <a href="/">Acceuil</a>
            <a href="/contact">Contact</a>
        </nav>

    </header>
    <article>
        <h1>Happy Recipes</h1>
    </article>

    <div class="contact-container">
        <div class="category-list">
            <h2>Contactez-nous</h2>
            <form action="submit_form.php" method="post">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
    <footer>
        <div class="empty"></div>
        <div>
            <a href="propos">À propos</a>
            <a href="conditions">Conditions générales</a>
            <a>&copy; 2023 Tous droits réservés. HappyRecipes.org</a>
        </div>

    </footer>
</body>
