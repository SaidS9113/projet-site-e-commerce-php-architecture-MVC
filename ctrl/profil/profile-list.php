<?php
// Sauvegarde de maintenance de session
session_start();

//Connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';

//Variable pour le titre
$pageTitle = "Liste des photos des utilisateurs ";

// Prépare la requête en selectionnant toute les colonnes dans la table user
$db = getConnection($dbConfig);
$query = 'SELECT * FROM user';
$statement = $db->prepare($query);
//Execute la requete
$successOrFailure = $statement->execute();
//Variable de bouclage foreach pour récuperer les informations dans la table
$listUser = $statement->fetchAll(PDO::FETCH_ASSOC);

//Rend la vus
include $_SERVER['DOCUMENT_ROOT'] . '/view/profil/profile-list.php';


