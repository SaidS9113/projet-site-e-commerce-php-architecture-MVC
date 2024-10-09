<?php
// model/cart/add.php

// Récupérer la quantité disponible en stock pour un produit donné
function getStockQuantity($dbConnection, $idProduct, $poids) {
    $stmt = $dbConnection->prepare('SELECT quantity FROM product_stock WHERE idProduct = ? AND poids = ?');
    $stmt->execute([$idProduct, $poids]);
    return $stmt->fetchColumn();
}

// Récupérer la quantité déjà dans le panier pour un utilisateur donné
function getCartQuantityForUser($dbConnection, $idUser, $idProduct, $poids) {
    $stmt = $dbConnection->prepare('SELECT SUM(quantity) FROM cart_product WHERE idUser = ? AND idProduct = ? AND poids = ?');
    $stmt->execute([$idUser, $idProduct, $poids]);
    return $stmt->fetchColumn();
}

// Ajouter un produit au panier
function storeInCart($dbConnection, $idUser, $idProduct, $poids, $quantity) {
    // On suppose que la fonction interne addToCart existe déjà, nous la remplaçons par storeInCart ici.
    return addToCart($idUser, $idProduct, $poids, $quantity, $dbConnection);
}
