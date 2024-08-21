<?php
// Sauvegarde de maintenance de session
session_start();

// Définit les clés de dictionnaire de la page
$pageTitle = 'Modifier le produit'; 

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

$idProduct = $_GET['id'];
// Charge l'article à modifier
$queryProduct = 'SELECT name, description FROM product WHERE id = :idProduct';
$statementProduct = $dbConnection->prepare($queryProduct);
$statementProduct->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
$statementProduct->execute();

// Récupère les informations du produit
$productInfo = $statementProduct->fetch(PDO::FETCH_ASSOC);

if (!$productInfo) {
    die('Produit non trouvé.');
}

// Charge la liste de product_stock
$queryStock = 'SELECT poids, price, quantity FROM product_stock WHERE idProduct = :idProduct';
$statementStock = $dbConnection->prepare($queryStock);
$statementStock->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
$statementStock->execute();
$stockInfo = $statementStock->fetchAll(PDO::FETCH_ASSOC);

// Passe les données à la vue pour affichage dans le formulaire
include $_SERVER['DOCUMENT_ROOT'] . '/view/add-article/update.php';
