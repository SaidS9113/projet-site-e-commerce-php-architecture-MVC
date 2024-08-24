<?php
//Ouvre une connexion a la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/avis.php';
// Ajoute un commentaire
// Lis les informations depuis la requête HTTP
$avis= [];
$avis['content'] = $_POST['contenu'];
$avis['date'] = date('Y-m-d H:i:s');
$avis['idUser'] = $_POST['idUser'];
// Crée les colonnes dans la table commentaire
$dbConnection = getConnection($dbConfig);
$isSuccess = create($avis['content'], $avis['date'], $avis['idUser'], $dbConnection);
// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/add-commentaire/pageDetail.php');
