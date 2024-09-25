<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/cart.php';

// Fonction pour ajouter un message flash
function addFlashMessage($message) {
    $_SESSION['flash_message'] = $message;
}

// Récupérer les données depuis l'URL (GET)
$idProduct = isset($_GET['idProduct']) ? intval($_GET['idProduct']) : 0;
$poids = isset($_GET['poids']) ? $_GET['poids'] : '';
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

// Assurer que les données sont valides
if ($idProduct <= 0 || $quantity <= 0 || empty($poids)) {
    addFlashMessage('Données invalides. Veuillez réessayer.');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
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
    addFlashMessage('Produit non trouvé.');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

// Si la quantité en stock est 0, afficher un message de rupture de stock
if ($stock <= 0) {
    addFlashMessage('Rupture de stock pour ce produit.');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

// Récupérer la quantité déjà dans le panier pour l'utilisateur connecté ou la session
if (isset($_SESSION['user']['id'])) {
    $idUser = $_SESSION['user']['id'];
    $stmt = $dbConnection->prepare('SELECT SUM(quantity) FROM cart_product WHERE idUser = ? AND idProduct = ? AND poids = ?');
    $stmt->execute([$idUser, $idProduct, $poids]);
    $alreadyInCart = $stmt->fetchColumn();
} else {
    // Pour les utilisateurs non connectés, vérifier la quantité dans la session
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
    addFlashMessage('Quantité demandée dépasse le stock disponible.');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

// Ajouter le produit au panier
if (!isset($_SESSION['user']['id'])) {
    // Pour les utilisateurs non connectés
    $sessionId = session_id();
    
    // Appeler la fonction addToCart pour enregistrer dans la base de données
    if (addToCart(null, $idProduct, $poids, $quantity, $dbConnection)) {
        addFlashMessage('Produit ajouté au panier.');
    } else {
        addFlashMessage('Erreur lors de l\'ajout au panier.');
    }
} else {
    // Pour les utilisateurs connectés
    if (addToCart($idUser, $idProduct, $poids, $quantity, $dbConnection)) {
        header('Location: /ctrl/cart/cart.php');
        exit;
    } else {
        addFlashMessage('Erreur lors de l\'ajout au panier.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

// Rediriger vers la page du panier après l'ajout réussi
header('Location: /ctrl/cart/cart.php');
exit;
