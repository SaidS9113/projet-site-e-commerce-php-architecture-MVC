<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/article.php';

// Ajoute un Marin

// Lis les informations depuis la requête HTTP
$vehicule = [];
$vehicule['nom'] = $_POST['nom'];
$vehicule['marque'] = $_POST['marque'];
$vehicule['price'] = $_POST['price'];
$vehicule['photo_filename'] = $_FILES['file']['name'];

// Crée le Marin
$dbConnection = getConnection($dbConfig);
$isSuccess = create($vehicule['nom'], $vehicule['marque'], $vehicule['price'], $vehicule['photo_filename'], $dbConnection);



session_start();



$_SESSION['msg']['info'] = [];
$_SESSION['msg']['error'] = [];

$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

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



// Prépare la requête SQL pour insérer un nouvel utilisateur
$db = getConnection($dbConfig);
$query = 'INSERT INTO vehicule (nom, marque, price, idCategorie, idUser, photo_filename) VALUES (:nom, :marque, :price, :idCategorie, :idUser, :photo_filename)';
$statement = $db->prepare($query);

// Lie les paramètres à la requête préparée
$statement->bindParam(':nom', $nom);
$statement->bindParam(':marque', $marque);
$statement->bindParam(':price', $price);
$statement->bindParam(':idCategorie', $idCategorie);
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
$_SESSION['msg']['info'][] = 'Le véhicule a été ajouté.';



// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/uploadImage.php';

// Redirige vers la liste des Marins
header('Location: ' . '/ctrl/add-article/list.php');
