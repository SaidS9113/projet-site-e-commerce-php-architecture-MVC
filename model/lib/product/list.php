<?php
// model/lib/product/list.php

// Récupérer la liste des produits et leurs informations de stock
function getProductList($dbConnection) {
    $query = 'SELECT product.id, product.name, product.description, product_stock.poids, product_stock.price, product_stock.quantity, product.photo_filename';
    $query .= ' FROM product';
    $query .= ' LEFT JOIN product_stock ON product.id = product_stock.idProduct';
    $statement = $dbConnection->prepare($query);
    
    // Exécute la requête
    $successOrFailure = $statement->execute();
    
    // Récupère les informations
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
