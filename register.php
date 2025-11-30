<?php
session_start();
require "fonctions.php";

$pdo = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $adresse = trim($_POST['adresse']);
    $password = trim($_POST['password']);
    $passwordConfirm = trim($_POST['password_confirm']);


    if ($nom === "" || $email === "" || $adresse === "" || $password === "" || $passwordConfirm === "") {
        die("Tous les champs sont obligatoires.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email invalide.");
    }

    if ($password !== $passwordConfirm) {
        die("Les mots de passe ne correspondent pas.");
    }

    if (emailExiste($pdo, $email)) {
        die("Cet email existe déjà.");
    }

    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
        die("Le mot de passe doit contenir au minimum une MAJUSCULE, 1 chiffre et un charact€r $pecial");
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (creerUtilisateur($pdo, $nom, $email, $passwordHash, $adresse)) {
        echo "Inscription réussie. <a href='login.php'>Se connecter</a>";
    } else {
        echo "Erreur lors de l'inscription.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="nebula-dot" style="left: 10%; top: 15%;"></div>
    <div class="nebula-dot secondary" style="right: 8%; bottom: 22%;"></div>

    <header class="bar-nav">
        <br>
        <button class="burger" aria-label="Menu">&#9776;</button>
        <nav class="nav-links">
            <ul>
                <!-- <li><i id="home-icon" class="fa-solid fa-house fa-2xl"></i></li> -->
                <li><a href="index.html">Accueil</a></li>
                <li><a href="register.php">Inscription</a></li>
                <li><a href="login.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-register">
        <div class="grid-two">

            <section class="card">
                <h3>Créer un compte</h3>
                <form method="POST">
                    <div class="field">
                        <label for="nom">Nom</label>
                        <input id="nom" type="text" name="nom" required>
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" required>
                    </div>
                    <div class="field">
                        <label for="adresse">Adresse physique</label>
                        <input id="addressInput" type="text" name="adresse" placeholder="Tapez votre adresse..." required>
                        <ul id="suggestions"></ul>
                    </div>
                    <div class="field">
                        <label for="password">Mot de passe</label>
                        <input id="password" type="password" name="password" required>
                    </div>
                    <div class="field">
                        <label for="password_confirm">Confirmer le mot de passe</label>
                        <input id="password_confirm" type="password" name="password_confirm" required>
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit">S'inscrire</button>
                        <a class="btn secondary" href="login.php">Déjà membre ?</a>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <script src="assets/js/burger_menu.js"></script>
        <script src="assets/js/Adresse.js"></script>
    </footer>
</body>
</html>