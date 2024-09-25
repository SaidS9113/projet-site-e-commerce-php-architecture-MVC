<?php

/**
 * Calcule la quantité totale d'articles dans le panier pour un utilisateur spécifique ou pour une session.
 *
 * @param int|null $userId ID de l'utilisateur ou null pour un utilisateur non connecté.
 * @param PDO $db Connexion à la base de données.
 * @return int Retourne la quantité totale d'articles dans le panier.
 */
function getCartTotalQuantity2(?int $userId, PDO $db): int
{
    $sessionId = session_id();
    $totalQuantity2 = 0;
    

    if ($userId !== null) {
        // Utilisateur connecté
        $query = 'SELECT SUM(quantity) FROM cart_product WHERE idUser = :userId';
        $statement = $db->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    } else {
        // Utilisateur non connecté
        $query = 'SELECT SUM(quantity) FROM cart_product WHERE sessionId = :sessionId';
        $statement = $db->prepare($query);
        $statement->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
    }

    $statement->execute();
    $totalQuantity2 = $statement->fetchColumn() ?: 0; // Renvoie 0 si aucune ligne n'est trouvée
  

    return (int)$totalQuantity2;
}
