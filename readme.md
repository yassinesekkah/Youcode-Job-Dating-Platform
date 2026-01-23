# Job-Dating — Framework PHP MVC Minimaliste

## 📌 Présentation du projet

Ce projet consiste à développer un **framework PHP MVC minimaliste**, dans un objectif pédagogique, afin de comprendre en profondeur :

- L’architecture MVC
- La gestion des routes
- La sécurité des applications web
- La séparation Front Office / Back Office
- L’organisation interne d’un framework backend

Le framework est léger, structuré, sécurisé et extensible.
   
---

## 🎯 Objectifs du projet

- Implémenter un routeur personnalisé
- Comprendre le flux :
  **Request → Controller → Model → View**
- Mettre en place des mécanismes de sécurité essentiels
- Gérer l’authentification et les autorisations
- Séparer clairement le Front Office du Back Office
- Intégrer Twig comme moteur de templates

---

## 🚦 Fonctionnement global

1. La requête HTTP arrive sur `public/index.php`
2. Initialisation :
   - Autoload Composer
   - Sessions
   - Connexion à la base de données (Singleton)
   - Gestion centralisée des erreurs
3. Le routeur analyse l’URL et la méthode HTTP
4. Le contrôleur correspondant est exécuté
5. Le modèle interagit avec la base de données
6. La vue affiche le résultat (PHP ou Twig)

---

## 🧭 Routing

Les routes sont définies dans `config/routes.php`.

Exemple :

```php
$router->get('/', 'Front\\HomeController@index');
$router->get('/login', 'Front\\AuthController@loginForm');
$router->post('/login', 'Front\\AuthController@login');
$router->get('/admin', 'Back\\AdminController@dashboard');
```

🧩 Architecture MVC
Model

Classe Model générique avec opérations CRUD

Utilisation de PDO et des requêtes préparées

Protection contre les injections SQL

Controller

Contient la logique métier

Validation des données

Gestion de l’authentification et des permissions

Redirections et rendu des vues

View

Vues PHP et Twig

Aucune logique métier

Layouts séparés pour le Front et le Back Office


🛡️ Sécurité

Protection CSRF (token + vérification)

Protection contre les attaques XSS

Hashage des mots de passe

Vérification des mots de passe

Gestion sécurisée des sessions

Rôles utilisateurs

Permissions et ACL

Protection des routes sensibles


🔐 Authentification & Autorisations

Inscription et connexion des utilisateurs

Stockage des informations utilisateur en session

Vérification du rôle et des permissions

Accès restreint au Back Office


⚠️ Gestion des erreurs

Gestion centralisée des erreurs

Pages d’erreurs personnalisées :

403 — Accès refusé

404 — Page non trouvée

500 — Erreur serveur

Mode debug configurable pour faciliter le développement


🎨 Twig

Intégration de Twig via Composer


Utilisé pour :

les pages d’authentification

l’affichage des erreurs

Séparation stricte entre logique métier et affichage


⚡ Optimisation des performances

Autoload PSR-4 avec Composer

Connexion base de données en Singleton

Routeur léger

Requêtes préparées

Cache Twig activable

Mode debug désactivable en production


🚀 Installation

Cloner le projet

Installer les dépendances :

composer install


Configurer la base de données

Lancer le serveur :

php -S localhost:8000 -t public

📝 Conclusion

Ce framework a été développé dans un objectif pédagogique afin de maîtriser :

l’architecture MVC

la sécurité web

la structuration d’un framework backend

Il constitue une base solide pour des projets plus avancés.

👨‍💻 Auteur

Projet réalisé dans le cadre d’un apprentissage en développement web backend.