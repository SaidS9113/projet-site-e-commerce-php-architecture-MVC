<?php
//Ouvre une connexion a la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/commentaire.php';
// Ajoute un commentaire
// Lis les informations depuis la requête HTTP
$commentaire= [];
$commentaire['contenu'] = $_POST['contenu'];
$commentaire['date'] = date('Y-m-d H:i:s');
$commentaire['idUser'] = $_POST['idUser'];
// Crée les colonnes dans la table commentaire
$dbConnection = getConnection($dbConfig);
$isSuccess = create($commentaire['contenu'], $commentaire['date'], $commentaire['idUser'], $dbConnection);
// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/add-commentaire/pageDetail.php');
