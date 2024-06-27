<?php
// Sauvegarde de maintenance de session
session_start();

//Variable pour le titre
$titreSite = "SportCard";

// Définit les clés de dictionnaire de la page
$pageTitle = "Page detail de l'article";

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Prépare la requête en selectionnant les colonnes dans la table véhicule pour affichier ses informations
$query = ' SELECT vehicule.id, vehicule.nom, vehicule.marque, vehicule.price, vehicule.photo_filename, vehicule.idCategorie, vehicule.idUser ';
$query .= ' FROM vehicule';

$statement = $dbConnection->prepare($query);
// Exécute la requête
$successOrFailure = $statement->execute();
//Variable pour boucler pour recuperer les informations
$listVehicule = $statement->fetchAll(PDO::FETCH_ASSOC);

// Prépare la requête en selectionnant les colonnes dans la table commentaire pour affichier ses informations
$query = ' SELECT commentaire.id, commentaire.contenu, commentaire.date, commentaire.idUser';
$query .= ' FROM commentaire';
$statement = $dbConnection->prepare($query);

// Exécute la requête
$successOrFailure = $statement->execute();
//Variable pour boucler pour recuperer les informations
$listCommentaire = $statement->fetchAll(PDO::FETCH_ASSOC);

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/pageDetail.php';
