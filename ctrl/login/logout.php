<?php
// Sauvegarde de maintenance de session
session_start();

//détruit toutes les variables de session
$_SESSION = [];

// Rediriger vers la page de connexion
header('Location: /ctrl/login/display.php');