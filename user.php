<?php
session_start();
require "fonctions.php"; 

// verifie si la peronne est connecté en tant que user 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location : login.php");
    exit;
}

$pdo = getDB();
$user = getUserById($pdo, $_SESSION['user_id']);
?>

<!DOCTYPE html> 

<html lang="fr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Espace Utilisateur</title>
    </head>
    <header><h1>Compte de <?php echo $_SESSION['user_nom']; ?></h1></header>
    <ul>
        <li>
            <a href="delete.php">Suppression du compte</a>
        </li>
        <li>
            <a href="logout.php">Déconnexion</a>
        </li>
    </ul>
    <body>
        <h6>Infos Compte : </h6>
        <br>
        <p><strong> Email :</strong> <?php echo $user['email']; ?></p>
        <br>
        <p><strong> Adresse : </strong> <?php echo $user['email']; ?></p>
        <br>
        <p><strong>Role </strong><?php echo $_SESSION['role']; ?></p>
    </body>
</html>