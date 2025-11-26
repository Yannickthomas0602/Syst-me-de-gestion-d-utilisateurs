<?php
session_start();
require 'fonctions.php';
$pdo = getDB();

if (!isset($_GET['id'])) {
    die("ID utilisateur manquant.");
} 

$id = (int)$_GET['id'];

//récuperation de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) {
    die("Pas d utilisateur");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $adresse = trim($_POST['adresse']);
    $role_id = (int)$_POST['role_id']; 

    if (updateUser($pdo, $id, $nom, $email, $adresse, $role_id)) {
        echo "User mis à jour";
    }else {
        echo "User non mis à jour";
    }
}
?> 

<!DOCTYPE html> 

<html lang="fr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification Utilisateur</title>
    </head>
    <body>
        <header>
            <ul>
                <li>
                    <a href="index.html">Accueil</a>
                </li>
                <li>
                    <a href="logout.php">Déconnexion</a>
                </li>
            </ul>
        </header>
        <main>
            <div name="modif_user">
                <h3>Modification Utilisateur</h3>
                <fieldset>
                    <form method="POST">
                        <label>Nom : </label>
                        <input type="text" name="nom" value="<?=$user['nom'] ?>" required>
                        <br>
                        <label>Mail : </label>
                        <input type="email" name="email" value="<?=$user['email'] ?>" required>
                        <br>
                        <label>Adresse : </label>
                        <input type="text" name="adresse" value="<?=$user['adresse'] ?>" required>
                        <br>
                        <label>Role</label>
                        <select name="role_id">
                            <option value="1" <?= $user['role_id'] == 1 ? 'selected' : '' ?>>Admin</option>
                            <option value="2" <?= $user['role_id'] == 2 ? 'selected' : '' ?>>Utilisateur</option>
                        </select>
                        <br>
                        <button type="submit"> Modifier</button>
                    </form>

                </fieldset>

            </div>
        </main>
    </body>
</html>