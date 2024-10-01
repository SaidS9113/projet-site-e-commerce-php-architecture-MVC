<?php
// Sauvegarde de maintenance de session
session_start();

// Définit les clés de dictionnaire de la page
$pageTitle = 'Modifier le produit'; 

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/product/update-display.php';  // Inclure le modèle

$dbConnection = getConnection($dbConfig);

$idProduct = $_GET['id'];

// Charger l'article à modifier
$productInfo = getProductInfo($dbConnection, $idProduct);
if (!$productInfo) {
    die('Produit non trouvé.');
}

// Charger la liste de stock pour le produit
$stockInfo = getProductStock($dbConnection, $idProduct);

// Passe les données à la vue pour affichage dans le formulaire
include $_SERVER['DOCUMENT_ROOT'] . '/view/product/update.php';
