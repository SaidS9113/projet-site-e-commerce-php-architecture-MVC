<?php
// model/lib/product/update.php

// Récupérer les informations du produit par ID
function getProductInfo($dbConnection, $idProduct) {
    $queryProduct = 'SELECT id, name, description FROM product WHERE id = :idProduct';
    $statementProduct = $dbConnection->prepare($queryProduct);
    $statementProduct->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
    $statementProduct->execute();
    
    return $statementProduct->fetch(PDO::FETCH_ASSOC);
}

// Récupérer la liste de stock d'un produit par ID
function getProductStock($dbConnection, $idProduct) {
    $queryStock = 'SELECT poids, price, quantity FROM product_stock WHERE idProduct = :idProduct';
    $statementStock = $dbConnection->prepare($queryStock);
    $statementStock->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
    $statementStock->execute();
    
    return $statementStock->fetchAll(PDO::FETCH_ASSOC);
}
