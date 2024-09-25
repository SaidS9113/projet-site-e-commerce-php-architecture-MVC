<?php

// Sauvegarde de la session
session_start();
if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
}

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commande.php';
$dbConnection = getConnection($dbConfig);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'clear') {
    $message = clearCommandeTables($dbConnection);
}
// Prépare la requête en selectionnant les colonnes dans la table véhicule
$query = ' SELECT commande_info.idUser, commande_info.email, commande_product.name, commande_product.poids, commande_product.quantity, commande_info.total, commande_info.status, commande_info.order_date';
$query .= ' FROM commande_info';
$query .= ' LEFT JOIN commande_product ON commande_info.id = commande_product.idCommande_info';
$statement = $dbConnection->prepare($query);
// Exécute la requête
$successOrFailure = $statement->execute();
//Variable pour boucler pour recuperer les informations
$listCommande = $statement->fetchAll(PDO::FETCH_ASSOC);



// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/commande.php';