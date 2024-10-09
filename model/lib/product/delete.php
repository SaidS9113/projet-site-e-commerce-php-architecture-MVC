<?php
// model/lib/product/delete.php

// Supprimer une option de produit par ID et poids
function deleteProductOption($dbConnection, $idProduct, $poids) {
    $queryOption = 'DELETE FROM product_stock WHERE idProduct = :idProduct AND poids = :poids';
    $statementOption = $dbConnection->prepare($queryOption);
    $statementOption->bindParam(':idProduct', $idProduct);
    $statementOption->bindParam(':poids', $poids);
    return $statementOption->execute();
}

// Vérifier s'il reste des options pour un produit
function checkRemainingOptions($dbConnection, $idProduct) {
    $queryCheck = 'SELECT COUNT(*) FROM product_stock WHERE idProduct = :idProduct';
    $statementCheck = $dbConnection->prepare($queryCheck);
    $statementCheck->bindParam(':idProduct', $idProduct);
    $statementCheck->execute();
    return $statementCheck->fetchColumn();
}

// Supprimer un produit par ID
function deleteProduct($dbConnection, $idProduct) {
    $queryProduct = 'DELETE FROM product WHERE id = :idProduct';
    $statementProduct = $dbConnection->prepare($queryProduct);
    $statementProduct->bindParam(':idProduct', $idProduct);
    return $statementProduct->execute();
}
