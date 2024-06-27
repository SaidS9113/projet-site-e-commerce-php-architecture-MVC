<?php
// Sauvegarde de maintenance de session
session_start();

//Variable du titre
$titreSite = "SportCard";

// Définit les clés de dictionnaire de la page
$pageTitle = 'Article des véhicules';

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Prépare la requête en selectionnant les colonnes dans la table véhicule
$query = ' SELECT vehicule.id, vehicule.nom, vehicule.marque, vehicule.price, vehicule.photo_filename, vehicule.idCategorie, vehicule.idUser ';
$query .= ' FROM vehicule';
$statement = $dbConnection->prepare($query);

// Exécute la requête
$successOrFailure = $statement->execute();
//Variable de bouclage foreach pour recuperer les informations
$listVehicule = $statement->fetchAll(PDO::FETCH_ASSOC);

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/article.php';
