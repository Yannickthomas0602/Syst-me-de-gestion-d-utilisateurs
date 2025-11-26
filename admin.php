<?php
session_start();
require "fonctions.php";
$pdo = getDB();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin ') {
    header("Location : login.php");
    exit;
}
$stmt = $pdo->query("SELECT u.id, u.nom, u.email, u.adresse, r.role_name FROM users u JOIN roles r ON u.role_id = r.id");
$admin = $stmt->fetchAll();

?>


<!DOCTYPE html> 

<html lang="fr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Espace Administateur</title>
    </head>
    <body>
    <header>
    <h1>Compte de <?php echo $_SESSION['user_nom']; ?></h1>
    <ul>
        <li>
            <a href="delete.php">Suppression du compte</a>
        </li>
        <li>
            <a href="logout.php">Déconnexion</a>
        </li>
    </ul>
    </header>
    <main>
        <div name="liste_users">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($admin as $u): ?>
                <tr>
                    <td><?= $u['id']?></td>
                    <td><?= $u['nom']?></td>
                    <td><?= $u['email']?></td>
                    <td><?= $u['adresse']?></td>
                    <td><?= $u['role_name']?></td>
                    <td>
                        <a href="edit.php?id=<?= $u['id'] ?>">Modifer</a> |
                        <a href="changer_role.php?id=<?= $u['id'] ?>">Changer rôle</a>
                        <form action="delete_admin.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>    
        </div>
        <div name="Ajout d'utilisateur">
            <h3>Ajouter un utilisateur</h3>
            <form method="POST" action="add_user.php">
                <input type="text" name="nom" placeholder="Insérer le nom de l'utilisateur" required>
                <input type="email" name="email" placeholder="Insérer l'email de l'utilisateur" required>
                <input type="text" name="adresse" placeholder="Insérer l'adresse de l'utilisateur" required>
                <input type="password" name="password" placeholder="Insérer le mot de passe de l'utilisateur" required>
                <select name="role_id">
                    <option value="1">Administateur</option>
                    <option value="2">Utilisateur</option>
                </select>
                <button type="submit">Ajouter un utilisateur</button>
            </form>
        </div>
    </main>
    </body>
</html>