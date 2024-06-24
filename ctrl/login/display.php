<?php
$titrePage = "login";

session_start();

// Rends la vue
include $_SERVER['DOCUMENT_ROOT'] . '/view/login/display.php';
