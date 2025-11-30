<?php

session_start();
require "fonctions.php";

$pdo = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === "" || $password === "") {
        die("Veuillez remplir tous les champs.");
    }

    $user = getUserByEmail($pdo, $email);

    if (!$user) {
        die("Email ou mot de passe incorrect.");
    }

    if (!password_verify($password, $user['password'])) {
        die("Email ou mot de passe incorrect.");
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_nom'] = $user['nom'];
    $_SESSION['role'] = $user['role_name']; 

    // Redirection vers le bon espace, utilisateur ou admin 
    if ($user['role_name'] === 'admin ') {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
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

    <main class="page">
        <div class="grid-two">

            <section class="card">
                <h3>Accéder à ton compte</h3>
                <form method="POST">
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" required>
                    </div>
                    <div class="field">
                        <label for="password">Mot de passe</label>
                        <input id="password" type="password" name="password" required>
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit">Se connecter</button>
                        <a class="btn secondary" href="register.php">Créer un compte</a>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <script src="assets/js/burger_menu.js"></script>

    </footer>
</body>
</html>
