<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';

// Ajoute un Marin

// Lis les informations depuis la requête HTTP
$commentaire= [];
$commentaire['contenu'] = $_POST['contenu'];
$commentaire['date'] = date('Y-m-d H:i:s');
$commentaire['idUser'] = $_POST['idUser'];



// Crée le Marin
$dbConnection = getConnection($dbConfig);
$isSuccess = create($commentaire['contenu'], $commentaire['date'], $commentaire['idUser'], $dbConnection);

// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/add-commentaire/pageDetail.php');
