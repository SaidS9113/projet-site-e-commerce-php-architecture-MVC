<?php
// Sauvegarde de maintenance de session
session_start();

// Variable du titre
$titreSite = "MielNaturel";

// Définit les clés de dictionnaire de la page
$pageTitle = 'Boutique';

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/catalogue.php'; // Inclure le modèle

$dbConnection = getConnection($dbConfig);

// Récupère la liste des produits
$listProduct = getProductList($dbConnection);

// Définir l'URL de base pour la page de détails des produits
$baseDetailPageUrl = "/ctrl/pageDetail.php";

// Construire un tableau associatif avec les URLs de détail
$productUrls = [];
foreach ($listProduct as $product) {
    $productUrls[$product['id']] = $baseDetailPageUrl . "?id=" . urlencode($product['id']);
}

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/catalogue.php';
