<?php

/**
 * Récupère les informations d'un utilisateur.
 * 
 * @param string $email L'adresse e-mail de l'utilisateur.
 * @param PDO $db Connexion à la base de données.
 * @return array|null Les informations de l'utilisateur ou null en cas d'échec.
 */
function getUser(string $email, PDO $db): ?array
{
    // Prépare la requête
    $query = 'SELECT user.id, user.email, user.password, user.idRole, user.nom, .user.prenom';
    $query .= ' FROM user';
    $query .= ' WHERE user.email = :email';
    $statement = $db->prepare($query);
    $statement->bindParam(':email', $email);

    // Exécute la requête
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Si aucun utilisateur n'est trouvé, retourne null
    return $user ?: null;
}

/**
 * Récupère les informations d'un rôle.
 * 
 * @param string $code Le code du rôle.
 * @param PDO $db Connexion à la base de données.
 * @return array|null Les informations du rôle ou null en cas d'échec.
 */
function getRole(string $code, PDO $db): ?array
{
    $query = 'SELECT role.id, role.code, role.label FROM role WHERE role.code = :code';
    $statement = $db->prepare($query);
    $statement->bindParam(':code', $code);
    $statement->execute();
    $role = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$role) {
        error_log("Role non trouvé pour le code: $code");
    }

    return $role ?: null;
}



/** 
 * @param string $email Email de l'utilisateur.
 * @param string $password Mot de passe de l'utilisateur.
 * @param string $idRole Identifiant du rôle de l'utilisateur.
 * @param PDO $db Connexion à la BDD.
 * @return boolean Succès ou échec de l'insertion.
 * 
 */

 function create(string $email, string $password, string $idRole, string $nom, string $prenom, PDO $db): bool
 {
     // Prépare la requête SQL pour insérer un nouvel utilisateur
     $query = 'INSERT INTO user (email, password, idRole, nom, prenom) VALUES (:email, :password, :idRole, :nom, :prenom)';
     $statement = $db->prepare($query);
     
     // Lie les paramètres à la requête préparée
     $statement->bindParam(':email', $email);
     $statement->bindParam(':password', $password);
     $statement->bindParam(':idRole', $idRole);
     $statement->bindParam(':nom', $nom);
     $statement->bindParam(':prenom', $prenom);
     
     
     // Exécute la requête et retourne le succès ou l'échec
     $successOrFailure = $statement->execute();
 
     return $successOrFailure;
 }
