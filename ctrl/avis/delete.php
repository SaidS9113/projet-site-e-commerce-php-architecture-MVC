<?php
session_start(); // Démarre la session pour accéder aux données de session

// Ouvre une connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php'; // Connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php'; // Fonction pour obtenir la connexion PDO
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/avis.php'; // Fonctions liées aux avis

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: /ctrl/login/display.php");
    exit;
}

// Récupère les informations de session
$idUser = $_SESSION['user']['id']; // L'identifiant de l'utilisateur connecté
$idRole = $_SESSION['user']['idRole']; // Le rôle de l'utilisateur (10 = admin, 20 = utilisateur normal)

// Vérifie si l'identifiant de l'avis à supprimer est fourni via POST
if (!isset($_POST['idAvis'])) {
    $_SESSION['error'] = 'Identifiant de l\'avis non fourni.';
    // Redirection vers la page de détail
    $idProduct = htmlspecialchars($_POST['idProduct']);
    $poids = htmlspecialchars($_POST['poids']);
    $price = htmlspecialchars($_POST['price']);
    header('Location: /ctrl/pageDetail.php?id=' . $idProduct . '&poids=' . $poids . '&price=' . $price);
    exit;
}

$idAvis = (int)$_POST['idAvis']; // Récupère l'identifiant de l'avis à supprimer

// Connexion à la base de données
$db = getConnection($dbConfig); // Fonction pour obtenir la connexion PDO

// Appel à la fonction de suppression
if (deleteAvis($idAvis, $idUser, $idRole, $db)) {
    $_SESSION['success'] = 'L\'avis a été supprimé avec succès.';
} else {
    $_SESSION['error'] = 'Vous n\'êtes pas autorisé à supprimer cet avis ou une erreur est survenue.';
}

// Redirection vers la page de détail
$idProduct = htmlspecialchars($_POST['idProduct']);
$poids = htmlspecialchars($_POST['poids']);
$price = htmlspecialchars($_POST['price']);
header('Location: /ctrl/pageDetail.php?id=' . $idProduct . '&poids=' . $poids . '&price=' . $price);
exit;
