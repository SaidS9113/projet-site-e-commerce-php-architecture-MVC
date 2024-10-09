<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lis les informations depuis la requête HTTP
    $user = [];
    $user['email'] = isset($_POST['email']) ? $_POST['email'] : '';
    $user['password'] = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $user['nom'] = isset($_POST['nom']) ? $_POST['nom'] : '';
    $user['prenom'] = isset($_POST['prenom']) ? $_POST['prenom'] : '';

    // Le JavaScript gère désormais la validation des mots de passe et autres
    // On peut directement passer à la création de l'utilisateur.

    // Hachage du mot de passe
    $passwordHash = password_hash($user['password'], PASSWORD_BCRYPT);

    // Crée la connexion à la base de données
    $dbConnection = getConnection($dbConfig);

    // Récupère le rôle public
    $rolePublic = getRole('P', $dbConnection);

    // Vérifie si le rôle a été trouvé avant de procéder à la création
    if ($rolePublic) {
        // Crée l'utilisateur
        $isSuccess = create($user['email'], $passwordHash, $rolePublic['id'], $user['nom'], $user['prenom'], $dbConnection);

        // Vérifie le succès de l'insertion
        if ($isSuccess) {
            // Redirige vers la page d'accueil ou une page protégée
            header('Location: /ctrl/login/display.php');
            exit();
       
        }
    }
}
