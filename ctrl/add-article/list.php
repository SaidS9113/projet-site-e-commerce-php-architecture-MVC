<?php

// Liste les Marins

// Définit les clés de dictionnaire de la page
$pageTitle = 'Liste des Marins';

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Prépare la requête
$query = ' SELECT marin.id, marin.matricule, marin.nom, marin.prenom';
$query .= ' FROM marin';
$statement = $dbConnection->prepare($query);

// Exécute la requête
$successOrFailure = $statement->execute();
$listMarin = $statement->fetchAll(PDO::FETCH_ASSOC);


// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/marin/list.php';
