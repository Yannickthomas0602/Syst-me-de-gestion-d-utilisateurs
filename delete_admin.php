<?php
session_start();
require "fonctions.php";
$pdo = getDB();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin ') {
    die("Accès refusé.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);


    if ($id === $_SESSION['user_id']) {
        die("Vous ne pouvez pas supprimer votre propre compte administrateur.");
    }
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: admin.php?message=Utilisateur supprimé");
        exit;

    } else { 
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "Requête invalide.";
}

?>