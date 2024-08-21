<?php
// Ouvre une connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Lis les informations depuis la requête HTTP
$product = [];
$product['id'] = $_POST['id'];
$product['name'] = $_POST['name'];
$product['description'] = $_POST['description'];
$product['poids'] = $_POST['poids'];
$product['price'] = $_POST['price'];
$product['quantity'] = $_POST['quantity'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST); // Affiche les données POST pour vérifier leur présence

    // Supposons que votre traitement se trouve ici
    $queryProduct = 'UPDATE product SET name = :name, description = :description WHERE id = :id';
    $statementProduct = $dbConnection->prepare($queryProduct);
    $statementProduct->bindParam(':name', $_POST['name']);
    $statementProduct->bindParam(':description', $_POST['description']);
    $statementProduct->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    
    $successProduct = $statementProduct->execute();
    
    if (!$successProduct) {
        var_dump($statementProduct->errorInfo()); // Affiche l'erreur SQL s'il y en a une
        die('Erreur lors de la mise à jour du produit.');
    }

    // Si tout va bien
    echo "Produit mis à jour avec succès";
    // header('Location: /ctrl/add-article/list.php');
    // exit();
}


// Deuxième requête : mise à jour de la table 'product_stock'
$queryStock = 'UPDATE product_stock SET price = :price, quantity = :quantity 
               WHERE idProduct = :idProduct AND poids = :poids';
$statementStock = $dbConnection->prepare($queryStock);
$statementStock->bindParam(':poids', $product['poids']);
$statementStock->bindParam(':price', $product['price']);
$statementStock->bindParam(':quantity', $product['quantity']);
$statementStock->bindParam(':idProduct', $product['id']);
$successStock = $statementStock->execute();

// Vérifie si la mise à jour de 'product_stock' a réussi
if (!$successStock) {
    die('La mise à jour du stock du produit a échoué : ' . $statementStock->errorInfo()[2]);
}

// Redirige vers la liste des articles
header('Location: /ctrl/add-article/list.php?id=' . $product['id']);
exit(); // Assurez-vous d'appeler exit() après une redirection pour arrêter l'exécution du script
