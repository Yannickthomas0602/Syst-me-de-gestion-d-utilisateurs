# Système de gestion d'utilisateur

### Description : 
Gestion d'utilisateur permettant l'inscription, la connexion et la gestion des rôles via une interface web en HTML5 / CSS3 / JAVA SCRIPT / PHP / MySQL

### Prérequis : 
* Base de données SQL 
* Serveur Local (XAMPP, WAMP, Laragon, etc.)

### Fonctionnalité : 
* Inscription et connexion des utilisateurs
* Gestion des rôles (admin/utilisateur)
* Suppression et modification des comptes
* API pour suggestions d’adresses
* Burger Menu responsive 
 
### Contenu du site :

* Un fichier index.html, page d'accueil permettant de se connecter ou de s'inscrire 
* Un fichier register.php, page d'inscription qui ajoute un nouvel utilisateur à la base de donnée 
* Un fichier login.php, pge de connexion permet de se connecter en tant qu'utilisateur du site 
* Un fichier user.php, page compte utilisateur, qui affiche les infos du compte
* Un fichier admin.php, page compte admin, qui permet de gérer la base de donnée des comptes (Modifier, supprimer, changer le role, ajouter un compte)
    * Un fichier edit.php, permet de modifier un utilisateur 
    * Un fichier delete_admin.php, qui permet de supprimer un utilisateur via la page admin
    * Un fichier changer_role.php, qui permet de changer le role d'un utilisateur
    * Un fichier add_user.php, qui permet d'ajouter un utilisateur en tant qu'admin 
* Un fichier delete.php, qui permet de supprimer son propre compte en tant qu'utilisateur
* Un fichier logout.php, deconnexion du compte utilisateur 
* Un fichier fonctions.php, regroupe toutes les fonctions en php
* Un fichier Adresse.js, utilise l'API BAN qui regroupe toutes les adresses françaises -> suggestions dans l'input adresse de register.php
* Deux fichier de style CSS
* Une base de donnée SQL qui regroupe tous les utilisateurs 
* Fichier burger_menu.js, qui permet l'utilisation du "Menu Burger" via une interface mobile 

### Installation : 
1. Installer un serveur local avec XAMPP, WAMP, Laragon...
2. Cloner le dépot 
```bash 
git clone https://github.com/Yannickthomas0602/Syst-me-de-gestion-d-utilisateurs.git

