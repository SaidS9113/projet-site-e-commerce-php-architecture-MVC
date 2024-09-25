<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/user.php';

var_dump('$POST : ', $_POST);
// Lis les informations depuis la requête HTTP
$user = [];
$user['email'] = $_POST['email'];
$user['password'] = $_POST['password'];

$passwordHash = password_hash($user['password'], PASSWORD_BCRYPT);

var_dump('user : ', $user);
//exit();


// Crée l'activité
$dbConnection = getConnection($dbConfig);
$rolePublic = getRole('P', $dbConnection);
$isSuccess = create($user['email'], $passwordHash, $rolePublic['id'], $dbConnection);

// Redirige vers la liste des Activités
header('Location: ' . '/ctrl/login/display.php');
