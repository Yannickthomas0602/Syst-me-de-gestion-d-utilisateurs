# Système de gestion d'utilisateur

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