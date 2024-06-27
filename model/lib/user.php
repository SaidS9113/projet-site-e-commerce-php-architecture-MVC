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
    $query = 'SELECT user.id, user.email, user.password, user.idRole, photo_filename';
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
    // Prépare la requête
    $query = 'SELECT role.id, role.code, role.label';
    $query .= ' FROM role';
    $query .= ' WHERE role.code = :code';
    $statement = $db->prepare($query);
    $statement->bindParam(':code', $code);

    // Exécute la requête
    $statement->execute();
    $role = $statement->fetch(PDO::FETCH_ASSOC);

    // Si aucun rôle n'est trouvé, retourne null
    return $role ?: null;
}
