<?php
// Sauvegarde de maintenance de session
session_start();

//Variable titre
$titlePage = "login d'authentification";

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/login/display.php';
