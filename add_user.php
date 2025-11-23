<?php
require "fonctions.php";
$pdo = getDB();

$nom = trim($_POST['nom']);
$email = trim($_POST['email']);
$adresse = trim($_POST['adresse']);
$passwordHash = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
$role_id = trim($_POST['role_id']);

$stmt = $pdo->prepare("INSERT INTO users (nom, email, adresse, password, role_id) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$nom, $email, $adresse, $passwordHash, $role_id]);

header("Location: admin.php"); 
exit;
?>
