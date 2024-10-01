<?php
// Sauvegarde de maintenance de session
session_start();

// Liste les produits
// Définit les clés de dictionnaire de la page
$pageTitle = 'Liste des produits'; 

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/product/list.php';  // Inclure le modèle

$dbConnection = getConnection($dbConfig);

// Récupérer la liste des produits
$listProduct = getProductList($dbConnection);

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/product/list.php';
