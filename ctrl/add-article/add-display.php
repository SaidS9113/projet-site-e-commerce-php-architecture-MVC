<?php
// Sauvegarde de maintenance de session
session_start();
// Titre
$pageTitle = 'Ajout product';

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/add-article/add.php';

