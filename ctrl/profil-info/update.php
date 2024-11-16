<?php
// Ouvre une connexion à la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/profil-info/update.php'; // Inclure le modèle

session_start(); // Assurez-vous que la session est démarrée

$dbConnection = getConnection($dbConfig);

// Lis les informations depuis la requête HTTP
$user = [];
$user['id'] = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
$user['nom'] = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
$user['prenom'] = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
$user['email'] = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$user['password'] = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$user['adresse'] = isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : '';
$user['code_postal'] = isset($_POST['code_postal']) ? htmlspecialchars($_POST['code_postal']) : '';
$password_confirm = isset($_POST['password_confirm']) ? htmlspecialchars($_POST['password_confirm']) : ''; // Champ de confirmation du mot de passe

// Vérifiez si la méthode de la requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez si le mot de passe et la confirmation du mot de passe correspondent
    if ($user['password'] === $password_confirm) {
        // Met à jour les informations de l'utilisateur
        $successUser = updateUserInfo($dbConnection, $user);
        
        if (!$successUser) {
            echo json_encode([
                'success' => false,
                'message' => "Erreur lors de la mise à jour de l'utilisateur."
            ]);
            exit(); // Arrête le script
        } else {
            // Mise à jour des informations de l'utilisateur dans la session
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['nom'] = $user['nom'];
            $_SESSION['user']['prenom'] = $user['prenom'];
            $_SESSION['user']['email'] = $user['email'];
            $_SESSION['user']['adresse'] = $user['adresse'];
            $_SESSION['user']['code_postal'] = $user['code_postal'];
            // Note : ne pas stocker le mot de passe en session pour des raisons de sécurité

            sleep(1); // Temporisation d'une seconde pour simuler un traitement
            echo json_encode([
                'success' => true,
                'message' => "Mise à jour réussie !"
            ]);
            exit(); // Arrête le script
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => "Les mots de passe ne correspondent pas. Aucune modification effectuée."
        ]);
        exit(); // Arrête le script
    }
}

// Redirige vers la page d'accueil si ce n'est pas une requête POST
header('Location: /ctrl/accueil.php');
exit(); // Assurez-vous d'appeler exit() après une redirection pour arrêter l'exécution du script
