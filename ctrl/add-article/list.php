<?php
// Sauvegarde de maintenance de session
session_start();

// Liste les Véhiules
// Définit les clés de dictionnaire de la page
$pageTitle = 'Liste des Marins'; 

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);
// Prépare la requête en selectionnant les colonnes dans la table véhicule
$query = ' SELECT vehicule.id, vehicule.nom, vehicule.marque, vehicule.price, vehicule.idCategorie, vehicule.idUser';
$query .= ' FROM vehicule';
$statement = $dbConnection->prepare($query);
// Exécute la requête
$successOrFailure = $statement->execute();
//Variable pour boucler pour recuperer les informations
$listVehicule = $statement->fetchAll(PDO::FETCH_ASSOC);
// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/add-article/list.php';
