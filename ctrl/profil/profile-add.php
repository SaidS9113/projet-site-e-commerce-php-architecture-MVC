<?php
// Sauvegarde de maintenance de session
session_start();

//Connexion à la BDD
require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';

$_SESSION['msg']['info'] = [];
$_SESSION['msg']['error'] = [];

$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

//Déclaration pour mettre la liste des formats images acceptées pour uppload
const MY_IMG_PNG = 'image/png';
const MY_IMG_JPG = 'image/jpeg';
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
    header('Location: ' . '/ctrl/profil/profile-add-display.php');
    exit();
}

// // Redimensionne l'image
// // WARN! sudo apt install php-gd
// $imgOriginal;
// if ($fileType == MY_IMG_PNG) {
//     $imgOriginal = imagecreatefrompng($fileTmpName);
// }
// if ($fileType == MY_IMG_JPG) {
//     $imgOriginal = imagecreatefromjpeg($fileTmpName);
// }
// $img = imagescale($imgOriginal, 200);
// imagepng($img, $fileTmpName);
// Insère les données en base
$db = getConnection($dbConfig);
$query = 'UPDATE user';
$query .= ' SET';
$query .= ' user.photo = :photo';
$query .= ' ,user.photo_filename = :photo_filename';
$query .= ' WHERE user.id = :idUser';
$statement = $db->prepare($query);
$statement->bindParam(':photo', fopen($fileTmpName, 'rb'), PDO::PARAM_LOB);
$statement->bindParam(':photo_filename', basename($fileName));
$statement->bindParam(':idUser', $_SESSION['user']['id']);
$successOrFailure = $statement->execute();
$id = $db->lastInsertId();

// Copie aussi le fichier d'avatar dans un répertoire
$uploadPath = $uploadDirectory . basename($fileName);
$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

// Ajoute un flash-message
$_SESSION['msg']['info'][] = 'Le Profil a été créé.';

// Redirige vers le détail du Profil créé
header('Location: ' . '/ctrl/profil/profile-list.php');