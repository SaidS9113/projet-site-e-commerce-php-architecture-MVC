<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/cart.php';

// Récupérer les données depuis l'URL (GET)
$idProduct = isset($_GET['idProduct']) ? intval($_GET['idProduct']) : 0;
$poids = isset($_GET['poids']) ? $_GET['poids'] : '';
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;
$sessionId = isset($_GET['sessionId']) ? $_GET['sessionId'] : '';

// Assurer que les données sont valides
if ($idProduct <= 0 || $quantity <= 0 || empty($poids) || empty($sessionId)) {
    header('Location: /error.php?message=Données invalides. Veuillez réessayer.');
    exit;
}

// Créer une connexion à la base de données
$dbConnection = getConnection($dbConfig);

// Récupérer la quantité disponible en stock
$stmt = $dbConnection->prepare('SELECT quantity FROM product_stock WHERE idProduct = ? AND poids = ?');
$stmt->execute([$idProduct, $poids]);
$stock = $stmt->fetchColumn();

// Vérifier si le produit existe et obtenir la quantité disponible
if ($stock === false) {
    header('Location: /error.php?message=Produit non trouvé.');
    exit;
}

// Si la quantité en stock est 0, afficher un message de rupture de stock
if ($stock <= 0) {
    header('Location: /error.php?message=Rupture de stock pour ce produit.');
    exit;
}

// Récupérer la quantité déjà dans le panier pour l'utilisateur connecté ou la session
if (isset($_SESSION['user']['id'])) {
    $idUser = $_SESSION['user']['id'];
    $stmt = $dbConnection->prepare('SELECT SUM(quantity) FROM cart_product WHERE idUser = ? AND idProduct = ? AND poids = ?');
    $stmt->execute([$idUser, $idProduct, $poids]);
    $alreadyInCart = $stmt->fetchColumn();
} else {
    $alreadyInCart = 0;
    if (isset($_SESSION['cart_product'])) {
        foreach ($_SESSION['cart_product'] as $item) {
            if ($item['idProduct'] == $idProduct && $item['poids'] == $poids) {
                $alreadyInCart = $item['quantity'];
                break;
            }
        }
    }
}

// Vérifier si la quantité demandée dépasse le stock disponible
if (($alreadyInCart + $quantity) > $stock) {
    header('Location: /error.php?message=Quantité demandée dépasse le stock disponible.');
    exit;
}

// Ajouter le produit au panier
if (!isset($_SESSION['user']['id'])) {
    // Pour les utilisateurs non connectés
    if (!isset($_SESSION['cart_product'])) {
        $_SESSION['cart_product'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart_product'] as &$item) {
        if ($item['idProduct'] == $idProduct && $item['poids'] == $poids) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart_product'][] = [
            'idProduct' => $idProduct,
            'poids' => $poids,
            'quantity' => $quantity,
            'sessionId' => $sessionId
        ];
    }
} else {
    // Pour les utilisateurs connectés
    if (addToCart($idUser, $idProduct, $poids, $quantity, $dbConnection)) {
        header('Location: /ctrl/cart/cart.php');
        exit;
    } else {
        header('Location: /error.php?message=Erreur lors de l\'ajout au panier.');
        exit;
    }
}

// Rediriger vers la page du panier après l'ajout réussi
header('Location: /ctrl/cart/cart.php');
exit;
