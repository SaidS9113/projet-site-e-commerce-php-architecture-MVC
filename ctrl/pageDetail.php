<?php
// pageDetail.php
session_start();

// Variable pour le titre
$titreSite = "MielNaturel";

// Définit les clés de dictionnaire de la page
$pageTitle = "Page détail des produits";

// Inclut les fichiers de configuration et de connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/pageDetail.php'; // Inclure le modèle

// Ouvre une connexion à la BDD
$dbConnection = getConnection($dbConfig);

// Initialise les variables pour le produit et ses poids
$product = null;
$productPoids = [];
$idProduct = null;  

// Vérifie si l'ID du produit est présent dans la requête
if (isset($_GET['id'])) {
    $idProduct = $_GET['id'];  

    // Valide l'ID du produit
    if (is_numeric($idProduct)) {
        try {
            // Récupère les détails du produit
            list($product, $productPoids) = getProductDetails($dbConnection, $idProduct);
            
            if ($product === null) {
                http_response_code(404); 
                echo "Produit non trouvé.";
                exit;
            }

        } catch (PDOException $e) {
            http_response_code(500); 
            echo "Erreur de base de données : " . htmlspecialchars($e->getMessage());
            exit;
        }
    } else {
        http_response_code(400); 
        echo "ID de produit invalide.";
        exit;
    }
} else {
    http_response_code(400); 
    echo "Aucun ID de produit fourni.";
    exit;
}

// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
    $idUser = (int)$_SESSION['user']['id'];
} else {
    $idUser = null;
}

// Récupère les avis du produit
$listAvis = getProductReviews($dbConnection, $idProduct);

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/pageDetail.php';
