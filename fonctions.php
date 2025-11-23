<?php

// ---------------------------------------
// Connexion PDO à la base de données
// ---------------------------------------
function getDB() {
    $host = "localhost";
    $dbname = "cour_login";
    $username = "root";
    $password = "";

    try {
        return new PDO(
            "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    } catch (PDOException $e) {
        die("Erreur de connexion BDD : " . $e->getMessage());
    }
}



// ---------------------------------------
// Vérifie si un email existe déjà
// ---------------------------------------
function emailExiste($pdo, $email) {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->rowCount() > 0;
}



// ---------------------------------------
// Inscrire un utilisateur
// ---------------------------------------
function creerUtilisateur($pdo, $nom, $email, $passwordHash, $adresse) {
    $stmt = $pdo->prepare("INSERT INTO users (nom, email, password, adresse) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$nom, $email, $passwordHash, $adresse]);
}



// ---------------------------------------
// Récupérer un utilisateur par email
// ---------------------------------------
function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT u.*, r.role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}



// ---------------------------------------
// Vérifier si un utilisateur est connecté
// ---------------------------------------
function isLogged() {
    return isset($_SESSION['user_id']);
}



// ---------------------------------------
// Bloquer une page si non connecté
// ---------------------------------------
function requireLogin() {
    if (!isLogged()) {
        header("Location: login.php");
        exit;
    }
}

function deleteAccount($pdo, $id){
	$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

function getUserById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getAllUsers($pdo) {
    $stmt = $pdo->query("SELECT u.id, u.nom, u.email, u.adresse, r.role_name FROM users u JOIN roles r ON u.role_id = r.id");
    return $stmt->fetchAll();
}

function updateUser($pdo, $id, $nom, $email, $adresse, $role_id) {
    $stmt = $pdo->prepare("UPDATE users SET nom = ?, email = ?, adresse = ?, role_id = ? WHERE id = ?");
    return $stmt->execute([$nom, $email, $adresse, $role_id, $id]);

}
?>
