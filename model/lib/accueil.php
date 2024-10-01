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


// Récupère la liste des avis avec les informations de l'utilisateur et le nom du produit
function getReviewList($dbConnection) {
    $query = 'SELECT avis.id, avis.content, avis.date, avis.idUser, user.email, product.name AS product_name'; // Sélection du nom du produit
    $query .= ' FROM avis';
    $query .= ' JOIN user ON avis.idUser = user.id'; 
    $query .= ' JOIN product ON avis.idProduct = product.id'; // Jointure avec la table product

    $statement = $dbConnection->prepare($query);
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
