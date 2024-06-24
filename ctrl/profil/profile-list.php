<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/lib/db.php';

session_start();

$pageTitle = 'Liste des profils';

$db = getConnection($dbConfig);
$query = 'SELECT * FROM user';
$statement = $db->prepare($query);
$successOrFailure = $statement->execute();
$listUser = $statement->fetchAll(PDO::FETCH_ASSOC);

include $_SERVER['DOCUMENT_ROOT'] . '/view//header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/view/profil/profile-list.php';
include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php';
