pour utiliser la partie admin, installer breeze:

-   S'assurer d'avoir fait la migration de la table users fournie par Laravel
-   Penser à sauvegarder nos routes déjà construites dans "web.php" pour les remettre après, car Breeze va les écraser
-   Exécuter la commande "composer require laravel/breeze"
-   Choisir "blade"
-   Une fois installé, on l'implémente dans notre application en faisant la commande "php artisan breeze:install"
-   Pour terminer, "npm install" puis "npm run dev" afin d'accéder au formulaire

-   Nous aurons tous les mêmes accès, on va mettre comme données:
    -- pseudo: admin
    -- mot de passe: adminadmin
    -- email: admin@admin.com

---
