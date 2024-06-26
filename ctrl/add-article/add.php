<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

// Ajoute un Marin

// Lis les informations depuis la requête HTTP
$vehicule = [];
$vehicule['nom'] = $_POST['nom'];
$vehicule['marque'] = $_POST['marque'];
$vehicule['price'] = $_POST['price'];
$vehicule['photo_filename'] = $_FILES['file']['name'];

// Crée le Marin
$dbConnection = getConnection($dbConfig);
$isSuccess = create($vehicule['nom'], $vehicule['marque'], $vehicule['price'], $vehicule['photo_filename'], $dbConnection);

// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/add-article/list.php');
