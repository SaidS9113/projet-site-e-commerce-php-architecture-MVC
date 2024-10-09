<?php
// model/lib/inscription/list.php

// Récupérer la liste des utilisateurs
function getUserList($dbConnection) {
    $query = 'SELECT user.id, user.email, user.password, user.idRole, nom, prenom FROM user';
    $statement = $dbConnection->prepare($query);
    
    // Exécute la requête
    if ($statement->execute()) {
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false; // En cas d'échec, retourne false
    }
}
