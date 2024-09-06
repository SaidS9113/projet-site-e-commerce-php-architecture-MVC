<?php
session_start(); // Démarre la session pour accéder aux données de session

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/avis.php';


// Ajoute un avis
// Lit les informations depuis la requête HTTP
$avis = [];
$avis['content'] = $_POST['content'];
$avis['date'] = date('Y-m-d H:i:s');
$avis['idUser'] = $_POST['idUser']; 
$avis['idProduct'] = $_POST['idProduct']; 
$avis['poids'] = $_POST['poids'];
$avis['price'] = $_POST['price'];

// Crée l'avis dans la table
$dbConnection = getConnection($dbConfig);
$isSuccess = createAvis($avis['content'], $avis['date'], $avis['idUser'], $avis['idProduct'], $dbConnection);

// Redirige vers la page de détails du produit 
$idProduct = $avis['idProduct'];
$poids = $avis['poids'];
$price = $avis['price'];

header('Location: /ctrl/pageDetail.php?id=' . $idProduct .'&poids='.$poids .'&price='.$price);
exit;
