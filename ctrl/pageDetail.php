<?php
// Sauvegarde de maintenance de session
session_start();

// Variable pour le titre
$titreSite = "MielNaturel";

// Définit les clés de dictionnaire de la page
$pageTitle = "Page detail des produits";

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Valider l'ID du produit
    if (is_numeric($productId)) {

        // 1. Requête pour récupérer les informations du produit
        $queryProduct = 'SELECT id, name, description, photo_filename FROM product WHERE id = :id';
        $statementProduct = $dbConnection->prepare($queryProduct);
        $statementProduct->bindParam(':id', $productId, PDO::PARAM_INT);
        $statementProduct->execute();
        $product = $statementProduct->fetch(PDO::FETCH_ASSOC);

        // 2. Requête pour récupérer les poids et prix disponibles
        $queryPoids = 'SELECT poids, price, quantity FROM product_stock WHERE idProduct = :id';
        $statementPoids = $dbConnection->prepare($queryPoids);
        $statementPoids->bindParam(':id', $productId, PDO::PARAM_INT);
        $statementPoids->execute();
        $productPoids = $statementPoids->fetchAll(PDO::FETCH_ASSOC);
    }
}


// Prépare la requête en selectionnant les colonnes dans la table commentaire pour affichier ses informations
$query = ' SELECT avis.id, avis.contenu, avis.date, avis.idUser';
$query .= ' FROM avis';
$statement = $dbConnection->prepare($query);


//Variable pour boucler pour recuperer les informations
$listAvis = $statement->fetchAll(PDO::FETCH_ASSOC);


// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/pageDetail.php';
