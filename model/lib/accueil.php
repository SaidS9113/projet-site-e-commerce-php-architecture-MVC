<?php
// model/lib/accueil.php

// Récupère la liste des produits
function getProductList($dbConnection) {
    $query = 'SELECT product.id, product.name, product.description, product.photo_filename, product_stock.poids, product_stock.price, product_stock.quantity';
    $query .= ' FROM product';
    $query .= ' LEFT JOIN product_stock ON product.id = product_stock.idProduct'; 
    $query .= ' GROUP BY product.id';

    $statement = $dbConnection->prepare($query);
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère la liste des avis
function getReviewList($dbConnection) {
    $query = 'SELECT avis.id, avis.content, avis.date, avis.idUser, user.email';
    $query .= ' FROM avis';
    $query .= ' JOIN user ON avis.idUser = user.id'; 

    $statement = $dbConnection->prepare($query);
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
