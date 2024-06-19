<?php

// Supprime un marin

// Lis les informations depuis la requête HTTP (id du Marin)
$idMarin = $_GET['id'];

// Ouvre une connexion à la Base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);

// Prépare la requête
$query = ' DELETE';
$query .= ' FROM marin';
$query .= ' WHERE marin.id = :idMarin';
$statement = $dbConnection->prepare($query);
$statement->bindParam(':idMarin', $idMarin);

// Exécute la requête
$successOrFailure = $statement->execute();

// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/marin/list.php');
