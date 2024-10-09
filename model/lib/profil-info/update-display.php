<?php
// model/lib/profil-info/update.php

// Récupère les informations d'un utilisateur par son ID
function getUserInfo($dbConnection, $idUser) {
    // Modifiez la requête SQL pour inclure 'first_name' et 'last_name'
    $queryUser = 'SELECT id, nom, prenom, email, password FROM user WHERE id = :idUser';
    $statementUser = $dbConnection->prepare($queryUser);
    $statementUser->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $statementUser->execute();

    // Retourne les informations sous forme de tableau associatif
    return $statementUser->fetch(PDO::FETCH_ASSOC);
}

