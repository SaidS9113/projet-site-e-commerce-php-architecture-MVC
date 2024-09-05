<?php
// Sauvegarde de la session
session_start();
if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
}

// Inclure le fichier de configuration de la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';       
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/cart.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/payment.php';

// Vérifier si l'utilisateur est connecté
$userId = $_SESSION['user']['id'] ?? null;

// Récupérer l'identifiant de session pour les utilisateurs non connectés
$sessionId = $_SESSION['sessionId'];

// Fonction pour calculer le total des produits dans le panier
function calculateTotal($cartProducts) {
    return array_reduce($cartProducts, function ($total, $product) {
        return $total + $product['price'] * $product['quantity'];
    }, 0);
}

// Fonction pour gérer le processus de commande et de paiement
function handleOrderAndPayment($userId, $sessionId, $dbConnection) {
    try {
        $dbConnection->beginTransaction();

        $cartProducts = getCartItems($userId, $sessionId, $dbConnection);
        if (empty($cartProducts)) {
            throw new Exception("Le panier est vide.");
        }

        $total = calculateTotal($cartProducts);

        // Créer la commande
        // Ajout d'un paramètre email pour la fonction createOrder
        $email = $_SESSION['user']['email'] ?? null;
        $orderId = createOrder($userId, $email, $total, $dbConnection);

        // Ajouter chaque produit à la commande
        foreach ($cartProducts as $product) {
            addOrderProduct($orderId, $product['idProduct'], $product['name'], $product['poids'], $product['quantity'], $product['price'], $dbConnection);
            updateStock($product['idProduct'], $product['poids'], $product['quantity'], $dbConnection);
        }


        clearCart($userId, $sessionId, $dbConnection);
        $dbConnection->commit();
        return true;

    } catch (Exception $e) {
        $dbConnection->rollBack();
        error_log("Erreur lors du traitement du paiement : " . $e->getMessage());
        return false;
    } finally {
        // Assurez-vous que la connexion à la base de données est fermée
        $dbConnection = null;
    }
}

// Fonction principale pour traiter le paiement
function processPayment() {
    global $userId, $sessionId;

    if (!$userId) {
        echo "Utilisateur non connecté. Veuillez vous connecter pour continuer.";
        return;
    }

    $dbConnection = getConnection($GLOBALS['dbConfig']);
    $paymentSuccess = handleOrderAndPayment($userId, $sessionId, $dbConnection);

    if ($paymentSuccess) {
        $message = "Paiement réussi ! Votre commande a été enregistrée.";
    } else {
        $message = "Erreur lors du traitement de votre paiement. Veuillez réessayer.";
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/view/payment/pay.php';
}

// Point d'entrée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'processPayment') {
    processPayment();
} else {
    $paymentSuccess = false;
    include $_SERVER['DOCUMENT_ROOT'] . '/view/payment/pay.php';
}
