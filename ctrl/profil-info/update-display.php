<?php
// Sauvegarde de maintenance de session
session_start();

// Définit les clés de dictionnaire de la page
$pageTitle = 'Modifier le produit'; 

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);


// Vérifie si l'utilisateur est connecté et a un ID dans la session
if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id'])) {
    die('ID utilisateur invalide ou non trouvé.');
}

$idUser = (int)$_SESSION['user']['id'];

// Charge l'article à modifier
$queryUser = 'SELECT id, email, password FROM user WHERE id = :idUser';
$statementUser = $dbConnection->prepare($queryUser);
$statementUser->bindParam(':idUser', $idUser, PDO::PARAM_INT);
$statementUser->execute();

// Récupère les informations de l'utilisateur
$userInfo = $statementUser->fetch(PDO::FETCH_ASSOC);

if (!$userInfo) {
    die('Utilisateur non trouvé.');
}

// Passe les données à la vue pour affichage dans le formulaire
include $_SERVER['DOCUMENT_ROOT'] . '/view/profil-info/update.php';
