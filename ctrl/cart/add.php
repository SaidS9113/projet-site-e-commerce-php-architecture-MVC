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

// Ajouter le produit au panier pour les utilisateurs non connectés
if (!isset($_SESSION['user']['id'])) {
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
            'sessionId' => $sessionId // Assurez-vous que ce champ est bien enregistré pour les non-connectés
        ];
    }
} else {
    // Code pour les utilisateurs connectés
    $idUser = $_SESSION['user']['id'];
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
