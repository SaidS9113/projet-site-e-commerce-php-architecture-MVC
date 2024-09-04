<?php
// Sauvegarde de maintenance de session
session_start();

// Variable pour le titre
$titreSite = "MielNaturel";

// Définit les clés de dictionnaire de la page
$pageTitle = "Page détail des produits";

// Inclut les fichiers de configuration et de connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';

// Ouvre une connexion à la BDD
$dbConnection = getConnection($dbConfig);

// Initialise les variables pour le produit et ses poids
$product = null;
$productPoids = [];

// Vérifie si l'ID du produit est présent dans la requête
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Valide l'ID du produit
    if (is_numeric($productId)) {
        try {
            // 1. Requête pour récupérer les informations du produit
            $queryProduct = 'SELECT id, name, description, photo_filename FROM product WHERE id = :id';
            $statementProduct = $dbConnection->prepare($queryProduct);
            $statementProduct->bindParam(':id', $productId, PDO::PARAM_INT);
            $statementProduct->execute();
            $product = $statementProduct->fetch(PDO::FETCH_ASSOC);

            // Vérifie si le produit a été trouvé
            if ($product === false) {
                // Redirection ou message d'erreur si le produit n'existe pas
                http_response_code(404); // Not Found
                echo "Produit non trouvé.";
                exit;
            }

            // 2. Requête pour récupérer les poids, prix et quantité disponibles
            $queryPoids = 'SELECT poids, price, quantity FROM product_stock WHERE idProduct = :id';
            $statementPoids = $dbConnection->prepare($queryPoids);
            $statementPoids->bindParam(':id', $productId, PDO::PARAM_INT);
            $statementPoids->execute();
            $productPoids = $statementPoids->fetchAll(PDO::FETCH_ASSOC);

            // Vérifie si des poids ont été trouvés
            if ($productPoids === false) {
                // Gérer l'erreur si aucun poids n'est trouvé pour le produit
                http_response_code(500); // Internal Server Error
                echo "Erreur lors de la récupération des poids du produit.";
                exit;
            }

        } catch (PDOException $e) {
            // Gère les erreurs de la base de données
            http_response_code(500); // Internal Server Error
            echo "Erreur de base de données : " . htmlspecialchars($e->getMessage());
            exit;
        }
    } else {
        // Redirection ou message d'erreur si l'ID n'est pas valide
        http_response_code(400); // Bad Request
        echo "ID de produit invalide.";
        exit;
    }
} else {
    // Redirection ou message d'erreur si aucun ID n'est fourni
    http_response_code(400); // Bad Request
    echo "Aucun ID de produit fourni.";
    exit;
}





// Prépare la requête en selectionnant les colonnes dans la table commentaire pour affichier ses informations
$query = ' SELECT avis.id, avis.contenu, avis.date, avis.idUser';
$query .= ' FROM avis';
$statement = $dbConnection->prepare($query);


//Variable pour boucler pour recuperer les informations
$listAvis = $statement->fetchAll(PDO::FETCH_ASSOC);


// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/pageDetail.php';
