<?php
// Sauvegarde de maintenance de session
session_start();

//Variable du titre
$pageTitle = 'Ajouter un nouveau profil';

//Rends la vu
include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/view/profil/profile-add.php';

