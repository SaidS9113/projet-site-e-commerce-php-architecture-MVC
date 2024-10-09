<?php
// model/lib/pageDetail.php

// Récupère les détails d'un produit par son ID
function getProductDetails($dbConnection, $idProduct) {
    // Requête pour récupérer les informations du produit
    $queryProduct = 'SELECT id, name, description, photo_filename FROM product WHERE id = :id';
    $statementProduct = $dbConnection->prepare($queryProduct);
    $statementProduct->bindParam(':id', $idProduct, PDO::PARAM_INT);
    $statementProduct->execute();
    $product = $statementProduct->fetch(PDO::FETCH_ASSOC);
    
    if (!$product) {
        return null; // Produit non trouvé
    }

    // Requête pour récupérer les poids, prix et quantité disponibles
    $queryPoids = 'SELECT poids, price, quantity FROM product_stock WHERE idProduct = :id';
    $statementPoids = $dbConnection->prepare($queryPoids);
    $statementPoids->bindParam(':id', $idProduct, PDO::PARAM_INT);
    $statementPoids->execute();
    $productPoids = $statementPoids->fetchAll(PDO::FETCH_ASSOC);
    
    return [$product, $productPoids];
}

// Récupère les avis d'un produit par son ID
function getProductReviews($dbConnection, $idProduct) {
    $query = 'SELECT avis.id, avis.content, avis.date, avis.idUser, user.email, user.nom, user.prenom';
    $query .= ' FROM avis';
    $query .= ' JOIN user ON avis.idUser = user.id'; 
    $query .= ' WHERE avis.idProduct = :idProduct';
    $statement = $dbConnection->prepare($query);
    $statement->bindParam(':idProduct', $idProduct, PDO::PARAM_INT); 
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
