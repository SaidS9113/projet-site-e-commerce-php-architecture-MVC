<?php

session_start();
// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
$dbConnection = getConnection($dbConfig);
// Prépare la requête


// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/pageDetail.php';