<?php

// Traitement du formulaire
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

// Lire les informations depuis la requête HTTP
$product = [];
$product['name'] = $_POST['name'];
$product['description'] = $_POST['description'];
$product['photo_filename'] = $_FILES['file']['name'];

// Crée une connexion à la base de données
$dbConnection = getConnection($dbConfig);

// Crée ou récupère l'ID du produit
$productId = createProduct($product['name'], $product['description'], $product['photo_filename'], $dbConnection);

$options = [];

// Fonction pour obtenir un prix ou une quantité avec une valeur par défaut
function getPostValue($key, $type = 'float', $default = null) {
    if (isset($_POST[$key]) && $_POST[$key] !== '') {
        if ($type === 'float') {
            return (float)$_POST[$key];
        } elseif ($type === 'int') {
            return (int)$_POST[$key];
        }
    }
    return $default;
}

// Ajouter ou mettre à jour les options en fonction des données POST
if (isset($_POST['add_250g'])) {
    $options['250g'] = [
        'price' => getPostValue('price_250g', 'float', null),
        'quantity' => getPostValue('quantity_250g', 'int', 0)
    ];
}
if (isset($_POST['add_500g'])) {
    $options['500g'] = [
        'price' => getPostValue('price_500g', 'float', null),
        'quantity' => getPostValue('quantity_500g', 'int', 0)
    ];
}
if (isset($_POST['add_1kg'])) {
    $options['1kg'] = [
        'price' => getPostValue('price_1kg', 'float', null),
        'quantity' => getPostValue('quantity_1kg', 'int', 0)
    ];
}

// Debugging: Affiche les valeurs du tableau options
echo '<pre>';
print_r($options);
echo '</pre>';

// Vérifier si $productId et $dbConnection sont définis
if (isset($productId) && isset($dbConnection)) {
    // Crée ou met à jour les options dans la base de données
    $isSuccess = createProductStock($productId, $options, $dbConnection);

    if ($isSuccess) {
        echo 'Produit et options ajoutés ou mis à jour avec succès !';
    } else {
        echo 'Erreur lors de l\'ajout ou de la mise à jour des options du produit.';
    }
} else {
    echo 'Erreur : Identifiant de produit ou connexion à la base de données manquants.';
}

//Pour les messages d'erreurs
$_SESSION['msg']['info'] = [];
$_SESSION['msg']['error'] = [];

$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

//Déclaration pour mettre la liste des formats images acceptées pour upload
const MY_IMG_PNG = 'image/png';
const MY_IMG_JPEG = 'image/jpeg'; // Remplace "image/jpg" par "image/jpeg"
const MY_IMG_SVG = 'image/svg+xml';
const LIST_ACCEPTED_FILE_TYPE = [MY_IMG_PNG, MY_IMG_JPEG, MY_IMG_SVG];
const FILE_MAX_SIZE = 10 * 1024 * 1024; // Exemple de taille maximale : 10 MB

// Lis les informations saisies dans le formulaire
$fileName = $_FILES['file']['name'];
$fileSize = $_FILES['file']['size'];
$fileTmpName  = $_FILES['file']['tmp_name'];
$fileType = $_FILES['file']['type'];

// Effectue différents tests sur les données saisies
$isSupportedFileType = in_array($fileType, LIST_ACCEPTED_FILE_TYPE);
if (!$isSupportedFileType) {
    // Ajoute un flash-message
    $_SESSION['msg']['error'][] = 'Les seuls formats de fichier acceptés sont : ' . implode(',', LIST_ACCEPTED_FILE_TYPE);
}
if ($fileSize > FILE_MAX_SIZE) {
    $_SESSION['msg']['error'][] = 'Le fichier est trop volumineux. Taille maximale : ' . (FILE_MAX_SIZE / (1024 * 1024)) . ' MB.';
}

$hasErrors = !empty($_SESSION['msg']['error']);
if ($hasErrors) {
    // Redirige vers le formulaire pour corrections
    header('Location: ' . '/ctrl/product/add-display.php');
    exit();
}

// Copie aussi le fichier dans le répertoire d'upload
$uploadPath = $uploadDirectory . basename($fileName);
$didUpload = move_uploaded_file($fileTmpName, $uploadPath);
if ($didUpload) {
    $_SESSION['msg']['info'][] = 'Le produit a été ajouté.';
} else {
    $_SESSION['msg']['error'][] = 'Erreur lors de l\'upload de l\'image.';
}

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/uploadImage.php';

// Redirige vers la liste des produits
header('Location: ' . '/ctrl/product/list.php');
