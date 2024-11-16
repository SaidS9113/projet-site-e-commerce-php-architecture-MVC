<?php
function updateUserInfo($dbConnection, $user) {
    // Hachez le mot de passe avant de l'insérer dans la base de données
    $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
    
    // Modifiez la requête pour inclure le nom, le prénom, l'email, le mot de passe, l'adresse et le code postal
    $queryUser = 'UPDATE user SET nom = :nom, prenom = :prenom, email = :email, password = :password, adresse = :adresse, code_postal = :code_postal WHERE id = :id';
    
    $statementUser = $dbConnection->prepare($queryUser);
    
    // Liez les paramètres
    $statementUser->bindParam(':nom', $user['nom']);
    $statementUser->bindParam(':prenom', $user['prenom']);
    $statementUser->bindParam(':email', $user['email']);
    $statementUser->bindParam(':password', $hashedPassword); // Utilisez le mot de passe haché
    $statementUser->bindParam(':adresse', $user['adresse']);
    $statementUser->bindParam(':code_postal', $user['code_postal']);
    $statementUser->bindParam(':id', $user['id']);
    
    // Exécutez la requête et retournez le résultat
    return $statementUser->execute();
}
