<?php

session_start();

// Liste les clés de dictionnaire de la page
$pageTitle = 'Ajouter un nouveau profil';

include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/view/profil/profile-add.php';
include $_SERVER['DOCUMENT_ROOT'] . '/view/_footer.php';
