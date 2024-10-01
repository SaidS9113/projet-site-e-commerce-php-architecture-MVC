<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/cart/cart.php';

// Connexion à la base de données
$dbConnection = getConnection($GLOBALS['dbConfig']);

// Vérifier si l'utilisateur est connecté
$userId = $_SESSION['user']['id'] ?? null;

// Obtenir la quantité totale d'articles dans le panier
$totalQuantity = getCartTotalQuantity($userId, $dbConnection);

