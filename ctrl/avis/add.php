<?php
session_start(); // Démarre la session pour accéder aux données de session

// Charger les dépendances nécessaires (base de données et modèle)
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php'; // Configuration base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php'; // Connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/avis.php'; // Fonctions liées aux avis

// Récupérer les informations depuis la requête HTTP POST
$avis = [];
$avis['content'] = $_POST['content'];
$avis['date'] = date('Y-m-d H:i:s');
$avis['idUser'] = intval($_POST['idUser']); // S'assurer que c'est un entier
$avis['idProduct'] = intval($_POST['idProduct']); // S'assurer que c'est un entier
$avis['poids'] = $_POST['poids'];
$avis['price'] = $_POST['price'];

// Connexion à la base de données
$dbConnection = getConnection($dbConfig);

// Appel du modèle pour créer l'avis
$isSuccess = createAvis($avis['content'], $avis['date'], $avis['idUser'], $avis['idProduct'], $dbConnection);

// Redirection vers la page de détails du produit avec les informations nécessaires
header('Location: /ctrl/pageDetail.php?id=' . $avis['idProduct'] .'&poids='.$avis['poids'] .'&price='.$avis['price']);
exit;
