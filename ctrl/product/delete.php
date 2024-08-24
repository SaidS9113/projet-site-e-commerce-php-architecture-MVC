<?php
// Supprime une option de produit spécifique (par exemple, 250g) sans supprimer tout le produit
// Lis les informations depuis la requête HTTP (id du produit et option spécifique)
$idProduct = $_GET['id'];  // ID du produit
$poids = $_GET['poids'];  // Option spécifique (par ex : 250g)


// Ouvre une connexion à la Base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

try {
    // Commence une transaction pour s'assurer que tout ou rien est supprimé
    $dbConnection->beginTransaction();

    // Supprime l'option spécifique (par exemple, 250g) dans la table product_option
    $queryOption = 'DELETE FROM product_stock WHERE idProduct = :idProduct AND poids = :poids';
    $statementOption = $dbConnection->prepare($queryOption);
    $statementOption->bindParam(':idProduct', $idProduct);
    $statementOption->bindParam(':poids', $poids);
    $successOption = $statementOption->execute();

    if (!$successOption) {
        // Affiche les erreurs liées à la suppression des options
        echo "Erreur lors de la suppression de l'option spécifique : ";
        print_r($statementOption->errorInfo());
        // Annule la transaction en cas d'erreur
        $dbConnection->rollBack();
        exit;
    }

    // Vérifie s'il reste encore des options pour ce produit
    $queryCheck = 'SELECT COUNT(*) FROM product_stock WHERE idProduct = :idProduct';
    $statementCheck = $dbConnection->prepare($queryCheck);
    $statementCheck->bindParam(':idProduct', $idProduct);
    $statementCheck->execute();
    $remainingOptions = $statementCheck->fetchColumn();

    // Si aucune option ne reste, supprime le produit lui-même
    if ($remainingOptions == 0) {
        $queryProduct = 'DELETE FROM product WHERE id = :idProduct';
        $statementProduct = $dbConnection->prepare($queryProduct);
        $statementProduct->bindParam(':idProduct', $idProduct);
        $successProduct = $statementProduct->execute();

        if (!$successProduct) {
            // Affiche les erreurs liées à la suppression du produit
            echo "Erreur lors de la suppression du produit : ";
            print_r($statementProduct->errorInfo());
            // Annule la transaction en cas d'erreur
            $dbConnection->rollBack();
            exit;
        }
    }

    // Si tout est réussi, on valide la transaction
    $dbConnection->commit();

    // Redirige vers la liste des produits après la suppression
    header('Location: ' . '/ctrl/product/list.php');
    exit;

} catch (PDOException $e) {
    // En cas d'exception, annule la transaction et affiche l'erreur
    $dbConnection->rollBack();
    echo "Erreur : " . $e->getMessage();
    exit;
}
