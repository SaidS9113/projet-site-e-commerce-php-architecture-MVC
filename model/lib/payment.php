<?php

/**
 * Récupère les informations du stock pour un produit spécifique.
 * 
 * @param int $idProduct ID du produit.
 * @param string $poids Poids sélectionné du produit.
 * @param PDO $db Connexion à la base de données.
 * @return array|false Retourne un tableau contenant les informations du stock en cas de succès, false en cas d'échec.
 */
function getProductStock(int $idProduct, string $poids, PDO $db) {
    $query = "SELECT * FROM product_stock WHERE idProduct = :idProduct AND poids = :poids";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
    $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Met à jour la quantité de stock pour un produit donné.
 * 
 * @param int $idProduct ID du produit.
 * @param string $poids Poids sélectionné du produit.
 * @param int $quantity Quantité à déduire du stock.
 * @param PDO $db Connexion à la base de données.
 * @return bool Retourne true en cas de succès, false en cas d'échec ou en cas de stock insuffisant.
 */
function updateStock(int $idProduct, string $poids, int $quantity, PDO $db) {
    try {
        // Récupérer le stock actuel
        $stockInfo = getProductStock($idProduct, $poids, $db);

        if ($stockInfo === false) {
            throw new Exception("Produit non trouvé.");
        }

        // Vérifier si la quantité demandée est disponible
        if ($stockInfo['quantity'] < $quantity) {
            throw new Exception("Stock insuffisant pour le produit avec ID $idProduct et poids $poids.");
        }

        // Mettre à jour le stock
        $query = "UPDATE product_stock SET quantity = quantity - :quantity WHERE idProduct = :idProduct AND poids = :poids";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
        $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (Exception $e) {
        error_log("Erreur lors de la mise à jour du stock : " . $e->getMessage());
        return false;
    }
}

/**
 * Crée une nouvelle commande pour l'utilisateur.
 * 
 * @param int|null $idUser ID de l'utilisateur. Peut être null pour les utilisateurs non connectés.
 * @param string $email Adresse email de l'utilisateur.
 * @param float $total Montant total de la commande.
 * @param PDO $db Connexion à la base de données.
 * @return int|false Retourne l'ID de la commande créée en cas de succès, false en cas d'échec.
 */
function createOrder(?int $idUser, string $email, float $total, PDO $db) {
    try {
        $query = "INSERT INTO commande_info (idUser, email, total) VALUES (:idUser, :email, :total)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $db->lastInsertId();
        } else {
            return false;
        }
    } catch (Exception $e) {
        error_log("Erreur lors de la création de la commande : " . $e->getMessage());
        return false;
    }
}

/**
 * Ajoute un produit à une commande après avoir vérifié le stock.
 * 
 * @param int $idCommande_info ID de la commande.
 * @param int $idProduct ID du produit.
 * @param string $name Nom du produit.
 * @param string $poids Poids sélectionné du produit.
 * @param int $quantity Quantité du produit commandé.
 * @param float $price Prix unitaire du produit.
 * @param PDO $db Connexion à la base de données.
 * @return bool Retourne true en cas de succès, false en cas d'échec.
 */
function addOrderProduct(int $idCommande_info, int $idProduct, string $name, string $poids, int $quantity, float $price, PDO $db) {
    try {
        // Vérifier le stock avant d'ajouter le produit à la commande
        $stockInfo = getProductStock($idProduct, $poids, $db);
        if ($stockInfo === false || $stockInfo['quantity'] < $quantity) {
            throw new Exception("Stock insuffisant pour le produit avec ID $idProduct et poids $poids.");
        }

        // Ajouter le produit à la commande
        $query = "INSERT INTO commande_product (idCommande_info, idProduct, name, poids, quantity, price) 
                  VALUES (:idCommande_info, :idProduct, :name, :poids, :quantity, :price)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':idCommande_info', $idCommande_info, PDO::PARAM_INT);
        $stmt->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);

        // Exécuter l'ajout
        return $stmt->execute();
    } catch (Exception $e) {
        error_log("Erreur lors de l'ajout du produit à la commande : " . $e->getMessage());
        return false;
    }
}

/**
 * Vide le panier après un paiement réussi.
 * 
 * @param int|null $userId ID de l'utilisateur ou null pour un utilisateur non connecté.
 * @param string $sessionId ID de session pour identifier les utilisateurs non connectés.
 * @param PDO $db Connexion à la base de données.
 * @return void
 */
function clearCart(?int $userId, string $sessionId, PDO $dbConnection) {
    try {
        if ($userId !== null) {
            // Supprimer tous les produits pour l'utilisateur connecté
            $query = 'DELETE FROM cart_product WHERE idUser = :userId';
            $statement = $dbConnection->prepare($query);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        } else {
            // Supprimer tous les produits pour la session non connectée
            $query = 'DELETE FROM cart_product WHERE sessionId = :sessionId';
            $statement = $dbConnection->prepare($query);
            $statement->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        }
        $statement->execute();
    } catch (Exception $e) {
        error_log("Erreur lors du vidage du panier : " . $e->getMessage());
    }
}
