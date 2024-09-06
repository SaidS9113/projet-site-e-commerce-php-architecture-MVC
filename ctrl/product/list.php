<?php
// Sauvegarde de maintenance de session
session_start();

// Liste les Véhiules
// Définit les clés de dictionnaire de la page
$pageTitle = 'Liste des produits'; 

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);
// Prépare la requête en selectionnant les colonnes dans la table véhicule
$query = ' SELECT product.id, product.name, product.description, product_stock.poids, product_stock.price, product_stock.quantity, product.photo_filename';
$query .= ' FROM product';
$query .= ' LEFT JOIN product_stock ON product.id = product_stock.idProduct';
$statement = $dbConnection->prepare($query);
// Exécute la requête
$successOrFailure = $statement->execute();
//Variable pour boucler pour recuperer les informations
$listProduct = $statement->fetchAll(PDO::FETCH_ASSOC);
// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/product/list.php';