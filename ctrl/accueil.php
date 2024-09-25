<?php
// Sauvegarde de maintenance de session
session_start();

//Variable du titre
$titreSite = "MielQualityS | Accueil";


// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/cart.php';

$dbConnection = getConnection($dbConfig);



// Prépare la requête en sélectionnant les colonnes dans la table produit
$query = 'SELECT product.id, product.name, product.description, product.photo_filename, product_stock.poids, product_stock.price, product_stock.quantity';
$query .= ' FROM product';
$query .= ' LEFT JOIN product_stock ON product.id = product_stock.idProduct'; // Jointure avec product_stock pour obtenir le prix
$query .= ' GROUP BY product.id';

$statement = $dbConnection->prepare($query);

// Exécute la requête
$successOrFailure = $statement->execute();

// Variable de bouclage foreach pour récupérer les informations
$listProduct = $statement->fetchAll(PDO::FETCH_ASSOC);

/// Définir l'URL de base pour la page de détails des produits
$baseDetailPageUrl = "/ctrl/pageDetail.php";

// Construire un tableau associatif avec les URLs de détail
$productUrls = [];

foreach ($listProduct as $product) {
    // Construire l'URL de détail en utilisant l'ID du produit
    $productUrls[$product['id']] = $baseDetailPageUrl . "?id=" . urlencode($product['id']);
}


if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
    $idUser = (int)$_SESSION['user']['id'];
} else {
    $idUser = null; // Vous pouvez définir $idUser à null ou gérer autrement l'absence d'utilisateur
}
// Prépare la requête pour sélectionner les colonnes de la table avis pour un produit donné
$query = 'SELECT avis.id, avis.content, avis.date, avis.idUser, user.email';
$query .= ' FROM avis';
$query .= ' JOIN user ON avis.idUser = user.id'; 


$statement = $dbConnection->prepare($query);

$statement->execute();

// Récupère les informations des avis
$listAvis = $statement->fetchAll(PDO::FETCH_ASSOC);

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/accueil.php';
