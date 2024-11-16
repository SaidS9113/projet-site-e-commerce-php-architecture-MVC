<?php
// model/lib/commande.php

// Efface les tables de commande et renvoie un message
function clearCommandeTables($dbConnection) {
    try {
        // Supposons que vous ayez une requête pour effacer les tables de commande
        $dbConnection->beginTransaction();
        
        // Exemple d'une requête d'effacement (à adapter selon vos besoins)
        $dbConnection->exec("DELETE FROM commande_product");
        $dbConnection->exec("DELETE FROM commande_info");

        $dbConnection->commit();
        return "Commandes effacées avec succès.";
    } catch (PDOException $e) {
        $dbConnection->rollBack();
        return "Erreur lors de l'effacement des commandes : " . htmlspecialchars($e->getMessage());
    }
}

// Récupère toutes les commandes et leurs détails
function getAllCommandes($dbConnection) {
    $query = 'SELECT commande_info.idUser, commande_info.email, commande_product.name, commande_product.poids, commande_product.quantity, ';
    $query .= 'commande_info.total, commande_info.status, commande_info.order_date, ';
    $query .= 'user.nom, user.prenom, user.adresse, user.code_postal ';
    $query .= 'FROM commande_info ';
    $query .= 'LEFT JOIN commande_product ON commande_info.id = commande_product.idCommande_info ';
    $query .= 'LEFT JOIN user ON commande_info.idUser = user.id';
    
    $statement = $dbConnection->prepare($query);
    $statement->execute();
    
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
