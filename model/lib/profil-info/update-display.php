<?php
// model/lib/profil-info/update.php

// Récupère les informations d'un utilisateur par son ID
function getUserInfo($dbConnection, $idUser) {
    // Modifiez la requête SQL pour inclure 'adresse' et 'code_postal'
    $queryUser = 'SELECT id, nom, prenom, email, password, adresse, code_postal FROM user WHERE id = :idUser';
    $statementUser = $dbConnection->prepare($queryUser);
    $statementUser->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $statementUser->execute();

    // Retourne les informations sous forme de tableau associatif
    return $statementUser->fetch(PDO::FETCH_ASSOC);
}
