<?php
// Sauvegarde de maintenance de session
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';

// Lis les informations saisies dans le formulaire
$form = [];
$form['email'] = $_POST['email'];
$form['password'] = $_POST['password'];

// Recherche l'Utilisateur
$dbConnection = getConnection($dbConfig);
$user = getUser($form['email'], $dbConnection);

/// Vérifie que l'Utilisateur existe
if ($user == null) {

    header('Location: ' . '/ctrl/login/display.php');
    exit();
} else {

    //message d'erreur qui s'affiche et ...
    $_SESSION['error'] = 'Identifiants incorrect, tu es pourrit.';
    // Vérifie que le mot de passe correspond
    $passwordOk = password_verify($form['password'], $user['password']);
    if (!$passwordOk) {
        header('Location: ' . '/ctrl/login/display.php');
        exit();
    } else {
        $_SESSION['error'] = 'Identifiants Correct, Bravo.';
    }

    // Stocke l'Utilisateur en session
    $_SESSION['user'] = $user;

    // Modifie la redirection selon que l'Utilisateur soit admin ou pas
    $isAdmin = $_SESSION['user']['idRole'] == 10;
    if ($isAdmin) {
        header('Location: ' . '/ctrl/accueil.php');
        exit();
    }
    header('Location: ' . '/ctrl/accueil.php');
}


// // Pour vérifier les informations d'identification
// if ($user !== null) {  // !== c'est l'opérateur strict pour vérifié si userdata retourne null (varDump pour verifier)
//     // Si l'utilisateur existe et que le mot de passe est correct...
//     // ...Alors ca crée une session pour l'utilisateur et le redirige vers la page welcome

//     $_SESSION['user'] = $userData;  // <=======CEST ICI QUE LE STOCKAGE DE LUTILISATEUR SE FAIT DANS SESSION 
//     header('Location: /ctrl/login/welcome.php'); // redirecion
//     exit();
// } else {
//     //message d'erreur qui s'affiche et ...
//     $_SESSION['error'] = 'Identifiants incorrects. Veuillez réessayer.';

//     // ...ca redirige vers la page de login
//     header('Location: /ctrl/login/display.php');
//     exit();

// } else {
//     // aussi ca redirige vers la page de login si les informations d'identification ne sont pas fournies avec un message d'érreur
//     $_SESSION['error'] = 'Veuillez entrer votre email et mot de passe.';
//     header('Location: /ctrl/login/display.php');
//     exit();
// }