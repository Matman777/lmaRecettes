<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="contact.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init('');
        })();
    </script>
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
        <h2>On a hâte de vous lire!</h2>

        <form id="contactForm">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message :</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit" value="Send">Envoyer</button>
        </form>

    </div>
    <footer>
        <div class="empty"></div>
        <div>
            <a href="propos">À propos</a>
            <a href="conditions">Conditions générales</a>
            <span>&copy; 2023 Tous droits réservés. HappyRecipes.org</span>
        </div>

    </footer>
    <script type="text/javascript">
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            emailjs.sendForm('HappyId', 'HappyTemplate', form)
                .then(function() {
                    console.log('SUCCESS!');
                    form.reset();
                    alert('Email envoyé avec succès !');
                }, function(error) {
                    console.log('FAILED...', error);
                });
        });
    </script>
</body>
