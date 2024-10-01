<?php
// Sauvegarde de la session
session_start();
if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
}

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/inscription/list.php';  // Inclure le modèle

$dbConnection = getConnection($dbConfig);

// Récupérer la liste des utilisateurs
$listUser = getUserList($dbConnection);

if ($listUser === false) {
    echo "Erreur lors de la récupération de la liste des utilisateurs.";
    exit();
}

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/inscription/list.php';
