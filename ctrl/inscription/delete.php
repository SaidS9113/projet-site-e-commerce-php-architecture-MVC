<?php
// Sauvegarde de la session
session_start();
if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
}

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/inscription/delete.php';  // Inclure le modèle

$dbConnection = getConnection($dbConfig);

// Vérifie si un utilisateur doit être supprimé
if (isset($_GET['id'])) {
    $deleteUserId = (int)$_GET['id'];

    // Appeler la fonction pour supprimer l'utilisateur
    if (deleteUser($dbConnection, $deleteUserId)) {
        // Redirection après suppression
        header("Location: /ctrl/inscription/list.php?message=deleted");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'utilisateur.";
    }
} else {
    echo "Aucun ID utilisateur spécifié.";
}
