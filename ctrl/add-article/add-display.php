<?php

session_start();

// Définit les clés de dictionnaire de la page
$pageTitle = 'Ajout vehicule';

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/add-article/add.php';

