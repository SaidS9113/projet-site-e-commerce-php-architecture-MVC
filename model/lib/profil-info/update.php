<?php
// model/lib/profil-info/update.php

// Met à jour les informations d'un utilisateur
function updateUserInfo($dbConnection, $user) {
    $queryUser = 'UPDATE user SET email = :email, password = :password WHERE id = :id';
    $statementUser = $dbConnection->prepare($queryUser);
    $statementUser->bindParam(':email', $user['email']);
    $statementUser->bindParam(':password', $user['password']);
    $statementUser->bindParam(':id', $user['id']);
    
    return $statementUser->execute();
}
