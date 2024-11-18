## Projet Mink Farm

### Pour installer le projet:

1. Cloner le projet
2. Installer les dépendances avec les commande `npm install` et `composer install`
3. Créer un fichier `.env` à la racine du projet et y ajouter les informations de connexion à la base de données
4. Créer la base de données et les seeders avec la commande `php artisan migrate --seed`
5. Linker le storage avec la commande `php artisan storage:link`
6. Generer la Key le projet avec la commande `php artisan key:generate`
7. Lancer le serveur avec les commande `php artisan serve` et `npm run build` pour compiler les assets
8. Se connecter avec les identifiants suivants:
    - email: mink@farm.com
    - password: password
9. Enjoy
