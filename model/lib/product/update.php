<?php
// model/lib/product/update.php

// Met à jour les informations du produit
function updateProduct($dbConnection, $product) {
    $queryProduct = 'UPDATE product SET name = :name, description = :description WHERE id = :id';
    $statementProduct = $dbConnection->prepare($queryProduct);
    $statementProduct->bindParam(':name', $product['name']);
    $statementProduct->bindParam(':description', $product['description']);
    $statementProduct->bindParam(':id', $product['id']);

    if (!$statementProduct->execute()) {
        throw new Exception('Erreur lors de la mise à jour du produit : ' . implode(', ', $statementProduct->errorInfo()));
    }
}

// Met à jour les informations de stock pour un produit
function updateProductStock($dbConnection, $product) {
    $queryStock = 'UPDATE product_stock SET price = :price, quantity = :quantity WHERE idProduct = :idProduct AND poids = :poids';
    $statementStock = $dbConnection->prepare($queryStock);
    $statementStock->bindParam(':poids', $product['poids']);
    $statementStock->bindParam(':price', $product['price']);
    $statementStock->bindParam(':quantity', $product['quantity']);
    $statementStock->bindParam(':idProduct', $product['id']);

    if (!$statementStock->execute()) {
        throw new Exception('Erreur lors de la mise à jour du stock du produit : ' . implode(', ', $statementStock->errorInfo()));
    }
}
