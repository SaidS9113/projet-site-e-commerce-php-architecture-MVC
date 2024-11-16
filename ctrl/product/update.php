<?php
// Ouvre une connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/product/update.php';  // Inclure le modèle

$dbConnection = getConnection($dbConfig);

// Lis les informations depuis la requête HTTP
$product = [];
$product['id'] = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
$product['name'] = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$product['description'] = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
$product['poids'] = isset($_POST['poids']) ? htmlspecialchars($_POST['poids']) : '';
$product['price'] = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';
$product['quantity'] = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Commence une transaction
        $dbConnection->beginTransaction();

        // Mise à jour des informations du produit
        updateProduct($dbConnection, $product);

        // Mise à jour des informations de stock
        updateProductStock($dbConnection, $product);

        // Valide la transaction si tout est correct
        $dbConnection->commit();

        // Redirige vers la liste des produits avec les informations mises à jour
        header('Location: /ctrl/product/list.php?id=' . $product['id'] . '&poids=' . $product['poids'] . '&price=' . $product['price'] . '&quantity=' . $product['quantity']);
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } catch (Exception $e) {
        // Si une erreur survient, annule la transaction
        $dbConnection->rollBack();
        die('Erreur : ' . $e->getMessage());
    }
}
