<?php
// Sauvegarde de maintenance de session
session_start();

//Variable du titre
$titreSite = "SportCard";

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/accueil.php';
