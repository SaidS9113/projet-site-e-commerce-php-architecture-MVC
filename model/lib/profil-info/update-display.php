<?php
// model/lib/profil-info/update.php

// Récupère les informations d'un utilisateur par son ID
function getUserInfo($dbConnection, $idUser) {
    $queryUser = 'SELECT id, email, password FROM user WHERE id = :idUser';
    $statementUser = $dbConnection->prepare($queryUser);
    $statementUser->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $statementUser->execute();

    return $statementUser->fetch(PDO::FETCH_ASSOC);
}
