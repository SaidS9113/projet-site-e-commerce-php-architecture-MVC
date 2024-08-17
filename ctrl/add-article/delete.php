<?php
// Supprime un produit et ses options associées
// Lis les informations depuis la requête HTTP (id du produit)
$idProduct = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ouvre une connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';

$dbConnection = getConnection($dbConfig);

try {
    // Commence une transaction
    $dbConnection->beginTransaction();

    // Supprimer les options associées
    $deleteOptionsQuery = 'DELETE FROM product_option WHERE idProduct = :idProduct';
    $deleteOptionsStatement = $dbConnection->prepare($deleteOptionsQuery);
    $deleteOptionsStatement->bindParam(':idProduct', $idProduct);
    $deleteOptionsStatement->execute();

    // Supprimer le produit
    $deleteProductQuery = 'DELETE FROM product WHERE id = :idProduct';
    $deleteProductStatement = $dbConnection->prepare($deleteProductQuery);
    $deleteProductStatement->bindParam(':idProduct', $idProduct);
    $deleteProductStatement->execute();

    // Commit la transaction
    $dbConnection->commit();

    // Redirige vers la liste des produits
    header('Location: /ctrl/add-article/list.php');
    exit; // Assure que le script s'arrête après la redirection
} catch (PDOException $e) {
    // Annule la transaction en cas d'erreur
    $dbConnection->rollBack();
    echo 'Erreur lors de la suppression du produit : ' . $e->getMessage();
}
