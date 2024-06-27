<?php
// Sauvegarde de maintenance de session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';

//Variable du titre
$pageTitle = 'Profil';

// Prépare la requête en selectionnant tla colonne id dans la table user
$db = getConnection($dbConfig);
$query = 'SELECT * FROM user WHERE id =' . $_GET['id'];
$statement = $db->prepare($query);
//Execute la requete
$successOrFailure = $statement->execute();
//Variable pour boucler pour recuperer les informations
$user = $statement->fetch(PDO::FETCH_ASSOC);


