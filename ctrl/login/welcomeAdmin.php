<?php
// Sauvegarde de maintenance de session
session_start();

$idRole = $_SESSION['user']['idRole'];
if ($idRole == 10) {
    include $_SERVER['DOCUMENT_ROOT'] . '/view/accueil.php';
    exit;
}

//Redirection
header('Location: ' . '/ctrl/login/display.php');
