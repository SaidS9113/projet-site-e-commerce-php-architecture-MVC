<?php
// model/commandeModel.php

function clearCommandeTables($dbConnection) {
    try {
        // Désactive les contraintes de clé étrangère pour permettre de vider les tables
        $dbConnection->exec('SET FOREIGN_KEY_CHECKS = 0');

        // Vidage des tables commande_product et commande_info
        $dbConnection->exec('TRUNCATE TABLE commande_product');
        $dbConnection->exec('TRUNCATE TABLE commande_info');

        // Réactive les contraintes de clé étrangère
        $dbConnection->exec('SET FOREIGN_KEY_CHECKS = 1');
        
        return "Les tables commande_info et commande_product ont été vidées avec succès.";
    } catch (PDOException $e) {
        return "Erreur lors de la suppression des données : " . $e->getMessage();
    }
}
