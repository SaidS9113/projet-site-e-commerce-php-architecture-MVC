<?php
/**
 * Crée un avis.
 * 
 * @param string $content Le contenu de l'avis.
 * @param string $date La date de l'avis.
 * @param int $idUser L'identifiant de l'utilisateur.
 * @param int $idProduct L'identifiant du produit.
 * @param PDO $db Connexion à la BDD.
 * @return boolean Succès ou échec. 
 */
function createAvis(string $content, string $date, int $idUser, int $idProduct, PDO $db) : bool
{
    // Vérifie si l'utilisateur existe
    $userCheck = $db->prepare('SELECT COUNT(*) FROM user WHERE id = :idUser');
    $userCheck->execute([':idUser' => $idUser]);
    if ($userCheck->fetchColumn() == 0) {
        throw new Exception('L\'utilisateur spécifié n\'existe pas.');
    }

    // Vérifie si le produit existe
    $productCheck = $db->prepare('SELECT COUNT(*) FROM product WHERE id = :idProduct');
    $productCheck->execute([':idProduct' => $idProduct]);
    if ($productCheck->fetchColumn() == 0) {
        throw new Exception('Le produit spécifié n\'existe pas.');
    }

    // Prépare la requête avec tous les paramètres
    $query = 'INSERT INTO avis (content, date, idProduct, idUser) VALUES (:content, :date, :idProduct, :idUser)';
    $statement = $db->prepare($query);
    
    // Lie les paramètres
    $statement->bindParam(':content', $content);
    $statement->bindParam(':date', $date);
    $statement->bindParam(':idProduct', $idProduct);
    $statement->bindParam(':idUser', $idUser);
    
    // Exécute la requête
    $successOrFailure = $statement->execute();

    return $successOrFailure;
}


/**
 * Supprime un avis.
 * 
 * @param int $idAvis L'identifiant de l'avis à supprimer.
 * @param int $idUser L'identifiant de l'utilisateur qui essaie de supprimer l'avis.
 * @param int $idRole Le rôle de l'utilisateur (10 = admin, 20 = utilisateur public).
 * @param PDO $db Connexion à la BDD.
 * @return bool Succès ou échec.
 */
function deleteAvis(int $idAvis, int $idUser, int $idRole, PDO $db) : bool
{
    // Récupérer l'avis pour vérifier l'utilisateur propriétaire
    $query = "SELECT idUser FROM avis WHERE id = :idAvis";
    $statement = $db->prepare($query);
    $statement->bindParam(':idAvis', $idAvis, PDO::PARAM_INT);
    $statement->execute();
    $avis = $statement->fetch(PDO::FETCH_ASSOC);

    // Si l'avis n'existe pas
    if (!$avis) {
        return false; // Aucun avis trouvé
    }

    // Si l'utilisateur est admin (idRole = 10), il peut supprimer n'importe quel avis
    // Sinon, vérifier que l'utilisateur est bien le propriétaire de l'avis
    if ($idRole == 10 || ($idRole == 20 && $avis['idUser'] == $idUser)) {
        // Préparer la requête de suppression
        $deleteQuery = "DELETE FROM avis WHERE id = :idAvis";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->bindParam(':idAvis', $idAvis, PDO::PARAM_INT);

        // Exécuter la requête de suppression
        return $deleteStmt->execute();
    }

    // Si l'utilisateur n'a pas le droit de supprimer cet avis
    return false;
}
