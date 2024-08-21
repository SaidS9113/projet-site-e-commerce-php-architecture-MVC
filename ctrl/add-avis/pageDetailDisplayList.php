<?php
// Sauvegarde de maintenance de session
session_start();

//Variable pour le titre
$titreSite = "MielNaturel";

// Définit les clés de dictionnaire de la page
$pageTitle = "Page detail des produits";

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Prépare la requête en selectionnant les colonnes dans la table commentaire pour affichier ses informations
$query = ' SELECT avis.id, avis.contenu, avis.date, avis.idUser';
$query .= ' FROM avis';
$statement = $dbConnection->prepare($query);

// Exécute la requête
$successOrFailure = $statement->execute();
//Variable pour boucler pour recuperer les informations
$listAvis = $statement->fetchAll(PDO::FETCH_ASSOC);

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/pageDetail.php';
