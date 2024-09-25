<?php
// Ouvre une connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Lis les informations depuis la requête HTTP
$product = [];
$product['id'] = $_POST['id'];
$product['name'] = $_POST['name'];
$product['description'] = $_POST['description'];
$product['poids'] = $_POST['poids'];
$product['price'] = $_POST['price'];
$product['quantity'] = $_POST['quantity'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Commence une transaction
        $dbConnection->beginTransaction();

        // Mise à jour des informations du produit dans la table 'product'
        $queryProduct = 'UPDATE product SET name = :name, description = :description WHERE id = :id';
        $statementProduct = $dbConnection->prepare($queryProduct);
        $statementProduct->bindParam(':name', $product['name']);
        $statementProduct->bindParam(':description', $product['description']);
        $statementProduct->bindParam(':id', $product['id']);

        if (!$statementProduct->execute()) {
            throw new Exception('Erreur lors de la mise à jour du produit : ' . implode(', ', $statementProduct->errorInfo()));
        }

        // Mise à jour des informations du stock dans la table 'product_stock'
        $queryStock = 'UPDATE product_stock SET price = :price, quantity = :quantity WHERE idProduct = :idProduct AND poids = :poids';
        $statementStock = $dbConnection->prepare($queryStock);
        $statementStock->bindParam(':poids', $product['poids']);
        $statementStock->bindParam(':price', $product['price']);
        $statementStock->bindParam(':quantity', $product['quantity']);
        $statementStock->bindParam(':idProduct', $product['id']);

        if (!$statementStock->execute()) {
            throw new Exception('Erreur lors de la mise à jour du stock du produit : ' . implode(', ', $statementStock->errorInfo()));
        }

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
