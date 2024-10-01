<?php
// model/lib/inscription/delete.php

// Supprimer un utilisateur par son ID
function deleteUser($dbConnection, $userId) {
    $deleteQuery = 'DELETE FROM user WHERE id = :id';
    $deleteStatement = $dbConnection->prepare($deleteQuery);
    $deleteStatement->bindParam(':id', $userId, PDO::PARAM_INT);
    return $deleteStatement->execute();
}
