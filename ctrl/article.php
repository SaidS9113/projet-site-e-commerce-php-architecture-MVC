<?php
// Sauvegarde de maintenance de session
session_start();

//Variable du titre
$titreSite = "MielNaturel";

// Définit les clés de dictionnaire de la page
$pageTitle = 'Article des véhicules';

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Prépare la requête en selectionnant les colonnes dans la table véhicule
$query = ' SELECT product.id, product.name, product.description, product_option.price, product.photo_filename, product.idProduct_option, product.idUser ';
$query .= ' FROM product';
$statement = $dbConnection->prepare($query);

// Exécute la requête
$successOrFailure = $statement->execute();
//Variable de bouclage foreach pour recuperer les informations
$listProduct = $statement->fetchAll(PDO::FETCH_ASSOC);

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/article.php';
