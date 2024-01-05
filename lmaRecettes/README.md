pour utiliser la partie admin, installer breeze:

-   S'assurer d'avoir fait la migration de la table users fournie par Laravel

-   !! Penser à sauvegarder nos routes déjà construites dans "web.php" pour les remettre après, car Breeze va les écraser !!

-   Exécuter la commande "composer require laravel/breeze"
-   Choisir "blade"
-   Une fois installé, on l'implémente dans notre application en faisant la commande "php artisan breeze:install"
-   Pour terminer, "npm install" puis "npm run dev" afin d'accéder au formulaire

-   Nous aurons tous les mêmes accès, on va mettre comme données:
    -- pseudo: admin
    -- mot de passe: adminadmin
    -- email: admin@admin.com

---

mettre cette route:

Route::get('/dashboard', [InfoController::class, 'afficheGraphes']);

dans le middleware d'authentification

---

Dans ressource/js/app.js, ajouter:

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

Pour afficher correctement la fonction logout de l'admin

---

Pour le design du formulaire de connexion admin:

Dans app.blade.php et guest.blade.php, ajouter:

@vite(['public/app.css', 'resources/js/app.js']) avant la fin du head.
