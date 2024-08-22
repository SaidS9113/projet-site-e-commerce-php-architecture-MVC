<?php
// Sauvegarde de maintenance de session
session_start();

//Variable pour le titre
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
        // Préparer la requête pour obtenir les détails du produit
        $query = 'SELECT product.id, product.name, product.description, product.photo_filename, product_stock.poids, product_stock.price, product_stock.quantity';
        $query .= ' FROM product';
        $query .= ' LEFT JOIN product_stock ON product.id = product_stock.idProduct';
        $query .= ' WHERE product.id = :id';

        $statement = $dbConnection->prepare($query);
        $statement->bindParam(':id', $productId, PDO::PARAM_INT);

        // Exécuter la requête
        $statement->execute();

        // Récupérer le produit
        $product = $statement->fetch(PDO::FETCH_ASSOC);

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
