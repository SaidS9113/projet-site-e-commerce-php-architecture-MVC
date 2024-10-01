<?php
// commande.php

// Sauvegarde de la session
session_start();
if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
}

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commande.php'; // Inclure le modèle

$dbConnection = getConnection($dbConfig);

// Gérer la demande d'effacement des commandes
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'clear') {
    $message = clearCommandeTables($dbConnection);
}

// Récupère toutes les commandes
$listCommande = getAllCommandes($dbConnection);

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/commande.php';
