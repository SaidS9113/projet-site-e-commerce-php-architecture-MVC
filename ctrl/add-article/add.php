<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/marin.php';

// Ajoute un Marin

// Lis les informations depuis la requête HTTP
$marin = [];
$marin['matricule'] = $_POST['matricule'];
$marin['nom'] = $_POST['nom'];
$marin['prenom'] = $_POST['prenom'];

// Crée le Marin
$dbConnection = getConnection($dbConfig);
$isSuccess = create($marin['matricule'], $marin['nom'], $marin['prenom'], $dbConnection);

// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/marin/list.php');
