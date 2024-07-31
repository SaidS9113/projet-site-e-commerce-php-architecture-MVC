<?php
// Sauvegarde de maintenance de session
session_start();

//Ouvre une connexion à  la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

// Lis les informations depuis la requête HTTP
$product = [];
$product['name'] = $_POST['nom'];
$product['description'] = $_POST['marque'];
$product_option['price'] = $_POST['price'];
$product['photo_filename'] = $_FILES['file']['name'];

// Crée une colonne dans la table voiture
$dbConnection = getConnection($dbConfig);
$isSuccess = create($product['name'], $product['description'], $product_option['price'], $product['photo_filename'], $dbConnection);

//Pour les messages d'erreurs
$_SESSION['msg']['info'] = [];
$_SESSION['msg']['error'] = [];

$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

//Déclaration pour mettre la liste des formats images acceptées pour uppload
const MY_IMG_PNG = 'image/png';
const MY_IMG_JPG = 'image/jpg';
const MY_IMG_SVG = 'image/svg+xml';
const LIST_ACCEPTED_FILE_TYPE = [MY_IMG_PNG, MY_IMG_JPG, MY_IMG_SVG];
const FILE_MAX_SIZE = 10;

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
if (true) {
    //...filesize
}

$hasErrors = !empty($_SESSION['msg']['error']);
if ($hasErrors) {

    // Redirige vers le formulaire pour corrections
    header('Location: ' . '/ctrl/add-article/add-display.php');
    exit();
}



// Prépare la requête SQL pour insérer une nouvelle colonne dans la table véhicule
$db = getConnection($dbConfig);
$query = 'INSERT INTO product (name, description, price, idProduct_option, idUser, photo_filename) VALUES (:name, :description, :price, :idProduct_option, :idUser, :photo_filename)';
$statement = $db->prepare($query);

// Lie les paramètres à la requête préparée
$statement->bindParam(':name', $nom);
$statement->bindParam(':description', $marque);
$statement->bindParam(':price', $price);
$statement->bindParam(':idproduct_option', $idCategorie);
$statement->bindParam(':idUser', $idUser);
$statement->bindParam(':photo_filename', $fileName);

// Exécute la requête et retourne le succès ou l'échec


// Insère les données en base
// $db = getConnection($dbConfig);
// $query = 'UPDATE vehicule';
// $query .= ' SET';
// $query .= ' vehicule.photo = :photo';
// $query .= ' ,vehicule.photo_filename = :photo_filename';
// $query .= ' WHERE vehicule.id = :idVehicule';
// $statement = $db->prepare($query);
// $statement->bindParam(':photo', fopen($fileTmpName, 'rb'), PDO::PARAM_LOB);
// $statement->bindParam(':photo_filename', basename($fileName));
// $statement->bindParam(':idVehicule', $_SESSION['vehicule']['id']);
// $successOrFailure = $statement->execute();
// $id = $db->lastInsertId();

// Copie aussi le fichier d'avatar dans un répertoire
$uploadPath = $uploadDirectory . basename($fileName);
$didUpload = move_uploaded_file($fileTmpName, $uploadPath);
// Ajoute un flash-message
$_SESSION['msg']['info'][] = 'Le produit a été ajouté.';

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/uploadImage.php';

// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/add-article/list.php');
