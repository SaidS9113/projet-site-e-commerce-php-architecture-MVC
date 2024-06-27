<?php
// Supprime un véhicule
// Lis les informations depuis la requête HTTP (id du véhicule)
$idVehicule = $_GET['id'];
// Ouvre une connexion à la Base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);
// Prépare la requête
$query = ' DELETE';
$query .= ' FROM vehicule';
$query .= ' WHERE vehicule.id = :idVehicule';
$statement = $dbConnection->prepare($query);
$statement->bindParam(':idVehicule', $idVehicule);
// Exécute la requête
$successOrFailure = $statement->execute();
// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/add-article/list.php');
