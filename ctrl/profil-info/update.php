<?php
// Ouvre une connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Lis les informations depuis la requête HTTP
$user = [];
$user['id'] = $_POST['id'];
$user['email'] = $_POST['email'];
$user['password'] = $_POST['password'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST); // Affiche les données POST pour vérifier leur présence

    // Supposons que votre traitement se trouve ici
    $queryUser = 'UPDATE user SET email = :email, password = :password WHERE id = :id';
    $statementUser = $dbConnection->prepare($queryUser);
    $statementUser->bindParam(':email', $_POST['email']);
    $statementUser->bindParam(':password', $_POST['password']);
    $statementUser->bindParam(':id', $_POST['id']);
    
    $successUser = $statementUser->execute();
    
    if (!$successUser) {
        var_dump($statementUser->errorInfo()); // Affiche l'erreur SQL s'il y en a une
        die('Erreur lors de la mise à jour du produit.');
    }

    // Si tout va bien
    echo "Produit mis à jour avec succès";
    // header('Location: /ctrl/add-article/list.php');
    // exit();
}


// Redirige vers la liste des articles
header('Location: /ctrl/accueil.php');
exit(); // Assurez-vous d'appeler exit() après une redirection pour arrêter l'exécution du script
