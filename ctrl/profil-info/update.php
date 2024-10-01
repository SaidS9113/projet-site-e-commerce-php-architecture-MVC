<?php
// Ouvre une connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/profil-info/update.php'; // Inclure le modèle

$dbConnection = getConnection($dbConfig);

// Lis les informations depuis la requête HTTP
$user = [];
$user['id'] = $_POST['id'];
$user['email'] = $_POST['email'];
$user['password'] = $_POST['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST); // Affiche les données POST pour vérifier leur présence

    // Met à jour les informations de l'utilisateur
    $successUser = updateUserInfo($dbConnection, $user);
    
    if (!$successUser) {
        var_dump($dbConnection->errorInfo()); // Affiche l'erreur SQL s'il y en a une
        die('Erreur lors de la mise à jour de l\'utilisateur.');
    }

    // Si tout va bien
    echo "Utilisateur mis à jour avec succès";
    // header('Location: /ctrl/add-article/list.php');
    // exit();
}

// Redirige vers la page d'accueil
header('Location: /ctrl/accueil.php');
exit(); // Assurez-vous d'appeler exit() après une redirection pour arrêter l'exécution du script
