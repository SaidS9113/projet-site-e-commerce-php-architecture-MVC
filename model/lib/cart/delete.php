<?php
// model/lib/cart/delete.php

// Supprimer une option spécifique d'un produit dans le panier (ex : 250g)
function deleteProductOption($dbConnection, $idProduct, $poids) {
    $queryOption = 'DELETE FROM cart_product WHERE idProduct = :idProduct AND poids = :poids';
    $statementOption = $dbConnection->prepare($queryOption);
    $statementOption->bindParam(':idProduct', $idProduct);
    $statementOption->bindParam(':poids', $poids);
    return $statementOption->execute();
}

// Vérifier s'il reste des options pour un produit
function countRemainingOptions($dbConnection, $idProduct) {
    $queryCheck = 'SELECT COUNT(*) FROM cart_product WHERE idProduct = :idProduct';
    $statementCheck = $dbConnection->prepare($queryCheck);
    $statementCheck->bindParam(':idProduct', $idProduct);
    $statementCheck->execute();
    return $statementCheck->fetchColumn();
}

// Supprimer un produit du panier lorsqu'il n'a plus d'options
function deleteProduct($dbConnection, $idProduct) {
    $queryProduct = 'DELETE FROM cart_product WHERE id = :idProduct';
    $statementProduct = $dbConnection->prepare($queryProduct);
    $statementProduct->bindParam(':idProduct', $idProduct);
    return $statementProduct->execute();
}
