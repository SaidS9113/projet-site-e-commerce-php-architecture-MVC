<?php
// Supprime une option de produit spécifique (par exemple, 250g) sans supprimer tout le produit
$idProduct = intval($_GET['id']);  // ID du produit, converti en entier
$poids = htmlspecialchars($_GET['poids']);  // Option spécifique (par ex : 250g), échappée

// Ouvre une connexion à la Base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/cart/delete.php';  // Inclure le modèle

$dbConnection = getConnection($dbConfig);

try {
    // Commence une transaction pour s'assurer que tout ou rien est supprimé
    $dbConnection->beginTransaction();

    // Supprime l'option spécifique (par exemple, 250g) dans la table cart_product
    $successOption = deleteProductOption($dbConnection, $idProduct, $poids);

    if (!$successOption) {
        // Affiche les erreurs liées à la suppression des options
        echo "Erreur lors de la suppression de l'option spécifique.";
        // Annule la transaction en cas d'erreur
        $dbConnection->rollBack();
        exit;
    }

    // Vérifie s'il reste encore des options pour ce produit
    $remainingOptions = countRemainingOptions($dbConnection, $idProduct);

    // Si aucune option ne reste, supprime le produit lui-même
    if ($remainingOptions == 0) {
        $successProduct = deleteProduct($dbConnection, $idProduct);

        if (!$successProduct) {
            // Affiche les erreurs liées à la suppression du produit
            echo "Erreur lors de la suppression du produit.";
            // Annule la transaction en cas d'erreur
            $dbConnection->rollBack();
            exit;
        }
    }

    // Si tout est réussi, on valide la transaction
    $dbConnection->commit();

    // Redirige vers la liste des produits après la suppression
    header('Location: ' . '/ctrl/cart/cart.php');
    exit;

} catch (PDOException $e) {
    // En cas d'exception, annule la transaction et affiche l'erreur
    $dbConnection->rollBack();
    echo "Erreur : " . $e->getMessage();
    exit;
}
