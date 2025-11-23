<?php
require "fonctions.php";
$pdo = getDB();

$id = $_GET['id'];
$newRole = ($_GET['role'] === 'admin') ? 1 : 2;

$stmt = $pdo->prepare("UPDATE users SET role_id = ? WHERE id = ?");
$stmt->execute([$newRole, $id]);

header("Location: admin.php");
exit;
?>