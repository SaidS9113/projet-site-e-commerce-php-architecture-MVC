<?php
// Sauvegarde de la session
session_start();
if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
}

// Inclure les modèles nécessaires pour interagir avec la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/cart.php';

// Créer une connexion à la base de données
$dbConnection = getConnection($dbConfig);

// Vérifier si l'utilisateur est connecté
$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

// Récupérer l'identifiant de session pour les utilisateurs non connectés
$sessionId = session_id();

// Récupérer les articles du panier pour l'utilisateur ou la session actuelle
$cartItems = getCartItems($userId, $sessionId, $dbConnection);

// Titre de la page
$pageTitle = 'Mon Panier';

// Rendre la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/cart.php';
