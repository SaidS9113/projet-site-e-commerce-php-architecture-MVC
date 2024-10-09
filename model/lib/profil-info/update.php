<?php
function updateUserInfo($dbConnection, $user) {
    // Hachez le mot de passe avant de l'insérer dans la base de données
    $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
    
    // Modifiez la requête pour inclure le nom, le prénom, l'email et le mot de passe
    $queryUser = 'UPDATE user SET nom = :nom, prenom = :prenom, email = :email, password = :password WHERE id = :id';
    
    $statementUser = $dbConnection->prepare($queryUser);
    
    // Liez les paramètres
    $statementUser->bindParam(':nom', $user['nom']);
    $statementUser->bindParam(':prenom', $user['prenom']);
    $statementUser->bindParam(':email', $user['email']);
    $statementUser->bindParam(':password', $hashedPassword); // Utilisez le mot de passe haché
    $statementUser->bindParam(':id', $user['id']);
    
    // Exécutez la requête et retournez le résultat
    return $statementUser->execute();
}

