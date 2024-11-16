<?php
// Supprime une option de produit spécifique (par exemple, 250g) sans supprimer tout le produit
// Lis les informations depuis la requête HTTP (id du produit et option spécifique)
$idProduct = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';  // ID du produit
$poids = isset($_GET['poids']) ? htmlspecialchars($_GET['poids']) : '';  // Option spécifique (par ex : 250g)

// Ouvre une connexion à la Base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/product/delete.php';  // Inclure le modèle

$dbConnection = getConnection($dbConfig);

try {
    // Commence une transaction pour s'assurer que tout ou rien est supprimé
    $dbConnection->beginTransaction();

    // Supprime l'option spécifique dans la table product_stock
    if (!deleteProductOption($dbConnection, $idProduct, $poids)) {
        // Affiche les erreurs liées à la suppression des options
        echo "Erreur lors de la suppression de l'option spécifique.";
        $dbConnection->rollBack();
        exit;
    }

    // Vérifie s'il reste encore des options pour ce produit
    $remainingOptions = checkRemainingOptions($dbConnection, $idProduct);

    // Si aucune option ne reste, supprime le produit lui-même
    if ($remainingOptions == 0) {
        if (!deleteProduct($dbConnection, $idProduct)) {
            // Affiche les erreurs liées à la suppression du produit
            echo "Erreur lors de la suppression du produit.";
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
