<?php
// Sauvegarde de maintenance de session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';

// Lis les informations saisies dans le formulaire
$form = [];
$form['email'] = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';  // Échappe l'email
$form['password'] = isset($_POST['password']) ? $_POST['password'] : '';  // Mot de passe non échappé

// Recherche l'Utilisateur
$dbConnection = getConnection($dbConfig);
$user = getUser($form['email'], $dbConnection);

// Vérifie que l'Utilisateur existe
if ($user == null) {
    // Redirection en cas d'utilisateur introuvable
    $_SESSION['error'] = 'Identifiants incorrects.';
    header('Location: ' . '/ctrl/login/display.php');
    exit();
} else {
    // Vérifie que le mot de passe correspond
    $passwordOk = password_verify($form['password'], $user['password']);
    if (!$passwordOk) {
        $_SESSION['error'] = 'Mot de passe incorrect.';
        header('Location: ' . '/ctrl/login/display.php');
        exit();
    } else {
        $_SESSION['error'] = 'Connexion réussie.';
    }

    // Stocke l'Utilisateur en session
    $_SESSION['user'] = $user;

    // Modifie la redirection selon que l'Utilisateur soit admin ou pas
    $isAdmin = $_SESSION['user']['idRole'] == 10;
    if ($isAdmin) {
        // Redirection pour les admins
        header('Location: ' . '/ctrl/product/list.php');
        exit();
    } else {
        // Redirection pour les utilisateurs non-admins
        header('Location: ' . '/ctrl/accueil.php'); // Remplace par la page que tu veux
        exit();
    }
}
