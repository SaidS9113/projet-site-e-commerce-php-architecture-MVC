<?php

// Sauvegarde de la session
session_start();
if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
}

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Vérifie si un utilisateur doit être supprimé
if (isset($_GET['id'])) {
    $deleteUserId = (int)$_GET['id'];

    // Prépare la requête de suppression
    $deleteQuery = 'DELETE FROM user WHERE id = :id';
    $deleteStatement = $dbConnection->prepare($deleteQuery);
    $deleteStatement->bindParam(':id', $deleteUserId, PDO::PARAM_INT);

    // Exécute la requête de suppression
    if ($deleteStatement->execute()) {
        // Redirection après suppression
        header("Location: /ctrl/inscription/list.php?message=deleted");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'utilisateur.";
    }
} else {
    echo "Aucun ID utilisateur spécifié.";
}
