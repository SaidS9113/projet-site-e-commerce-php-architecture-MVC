<?php

/**
 * Ajoute un produit au panier ou met à jour sa quantité s'il est déjà présent.
 * 
 * @param int|null $userId ID de l'utilisateur connecté ou null pour un utilisateur non connecté.
 * @param int $productId ID du produit à ajouter au panier.
 * @param string $poids Poids sélectionné du produit.
 * @param int $quantity Quantité du produit à ajouter.
 * @param PDO $db Connexion à la base de données.
 * @return int|false Retourne l'ID du produit ajouté ou mis à jour dans le panier en cas de succès, false en cas d'échec.
 */
function addToCart(?int $userId, int $productId, string $poids, int $quantity, PDO $db)
{
    // Si l'utilisateur est connecté
    if ($userId !== null) {
        $querySelectCartItem = 'SELECT id FROM cart_product WHERE idUser = :userId AND idProduct = :productId AND poids = :poids';
        $statementSelectCartItem = $db->prepare($querySelectCartItem);
        $statementSelectCartItem->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statementSelectCartItem->bindParam(':productId', $productId, PDO::PARAM_INT);
        $statementSelectCartItem->bindParam(':poids', $poids, PDO::PARAM_STR);
        $statementSelectCartItem->execute();

        if ($statementSelectCartItem->rowCount() > 0) {
            // Le produit est déjà dans le panier, on met à jour la quantité
            $cartItemId = $statementSelectCartItem->fetchColumn();
            $queryUpdateQuantity = 'UPDATE cart_product SET quantity = quantity + :quantity WHERE id = :cartItemId';
            $statementUpdateQuantity = $db->prepare($queryUpdateQuantity);
            $statementUpdateQuantity->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $statementUpdateQuantity->bindParam(':cartItemId', $cartItemId, PDO::PARAM_INT);

            if ($statementUpdateQuantity->execute()) {
                return $cartItemId;
            } else {
                return false;
            }
        } else {
            // Le produit n'est pas dans le panier, on l'ajoute
            $queryInsertCartItem = 'INSERT INTO cart_product (idUser, idProduct, poids, quantity) VALUES (:userId, :productId, :poids, :quantity)';
            $statementInsertCartItem = $db->prepare($queryInsertCartItem);
            $statementInsertCartItem->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statementInsertCartItem->bindParam(':productId', $productId, PDO::PARAM_INT);
            $statementInsertCartItem->bindParam(':poids', $poids, PDO::PARAM_STR);
            $statementInsertCartItem->bindParam(':quantity', $quantity, PDO::PARAM_INT);

            if ($statementInsertCartItem->execute()) {
                return $db->lastInsertId();
            } else {
                return false;
            }
        }
    } else {
        // Si l'utilisateur n'est pas connecté, on utilise une session pour identifier le panier
        $sessionId = session_id();
        $querySelectCartItem = 'SELECT id FROM cart_product WHERE sessionId = :sessionId AND idProduct = :productId AND poids = :poids';
        $statementSelectCartItem = $db->prepare($querySelectCartItem);
        $statementSelectCartItem->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        $statementSelectCartItem->bindParam(':productId', $productId, PDO::PARAM_INT);
        $statementSelectCartItem->bindParam(':poids', $poids, PDO::PARAM_STR);
        $statementSelectCartItem->execute();

        if ($statementSelectCartItem->rowCount() > 0) {
            // Le produit est déjà dans le panier, on met à jour la quantité
            $cartItemId = $statementSelectCartItem->fetchColumn();
            $queryUpdateQuantity = 'UPDATE cart_product SET quantity = quantity + :quantity WHERE id = :cartItemId';
            $statementUpdateQuantity = $db->prepare($queryUpdateQuantity);
            $statementUpdateQuantity->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $statementUpdateQuantity->bindParam(':cartItemId', $cartItemId, PDO::PARAM_INT);

            if ($statementUpdateQuantity->execute()) {
                return $cartItemId;
            } else {
                return false;
            }
        } else {
            // Le produit n'est pas dans le panier, on l'ajoute
            $queryInsertCartItem = 'INSERT INTO cart_product (sessionId, idProduct, poids, quantity) VALUES (:sessionId, :productId, :poids, :quantity)';
            $statementInsertCartItem = $db->prepare($queryInsertCartItem);
            $statementInsertCartItem->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
            $statementInsertCartItem->bindParam(':productId', $productId, PDO::PARAM_INT);
            $statementInsertCartItem->bindParam(':poids', $poids, PDO::PARAM_STR);
            $statementInsertCartItem->bindParam(':quantity', $quantity, PDO::PARAM_INT);

            if ($statementInsertCartItem->execute()) {
                return $db->lastInsertId();
            } else {
                return false;
            }
        }
    }
}

/**
 * Récupère tous les items du panier pour un utilisateur spécifique ou pour une session.
 * 
 * @param int|null $userId ID de l'utilisateur ou null pour un utilisateur non connecté.
 * @param PDO $db Connexion à la base de données.
 * @return array|false Retourne un tableau d'items du panier en cas de succès, false en cas d'échec.
 */
function getCartItems(?int $userId, string $sessionId, PDO $db)
{
    if ($userId !== null) {
        // Utilisateur connecté
        $query = 'SELECT cart_product.id, cart_product.idProduct, product.name, product.description, product.photo_filename, cart_product.poids, cart_product.quantity, product_stock.price
                  FROM cart_product
                  INNER JOIN product ON cart_product.idProduct = product.id
                  INNER JOIN product_stock ON product.id = product_stock.idProduct AND cart_product.poids = product_stock.poids
                  WHERE cart_product.idUser = :userId';
        $statement = $db->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    } else {
        // Utilisateur non connecté
        $query = 'SELECT cart_product.id, cart_product.idProduct, product.name, product.description, product.photo_filename, cart_product.poids, cart_product.quantity, product_stock.price
                  FROM cart_product
                  INNER JOIN product ON cart_product.idProduct = product.id
                  INNER JOIN product_stock ON product.id = product_stock.idProduct AND cart_product.poids = product_stock.poids
                  WHERE cart_product.sessionId = :sessionId';
        $statement = $db->prepare($query);
        $statement->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
    }
    
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


/**
 * Supprime un item du panier.
 * 
 * @param int $cartItemId ID de l'item du panier à supprimer.
 * @param PDO $db Connexion à la base de données.
 * @return bool Retourne true en cas de succès, false en cas d'échec.
 */
function removeFromCart(int $cartItemId, PDO $db)
{
    $query = 'DELETE FROM cart_product WHERE id = :cartItemId';
    $statement = $db->prepare($query);
    $statement->bindParam(':cartItemId', $cartItemId, PDO::PARAM_INT);
    
    return $statement->execute();
}


