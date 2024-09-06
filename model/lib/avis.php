<?php
/**
 * Crée un avis.
 * 
 * @param string content Le contenu de l'avis.
 * @param string date La date de l'avis.
 * @param int idUser L'identifiant de l'utilisateur.
 * @param int idProduct L'identifiant du produit.
 * @param PDO db Connexion à la BDD.
 * @return boolean Succès ou échec. 
 * 
 */
function createAvis(string $content, string $date, int $idUser, int $idProduct, PDO $db) : bool
{
    // Prépare la requête
    $query = 'INSERT INTO avis (content, date, idUser, idProduct) VALUES (:content, :date, :idUser, :idProduct)';
    $statement = $db->prepare($query);
    $statement->bindParam(':content', $content);
    $statement->bindParam(':date', $date);
    $statement->bindParam(':idUser', $idUser);
    $statement->bindParam(':idProduct', $idProduct);
    
    // Exécute la requête
    $successOrFailure = $statement->execute();

    return $successOrFailure;
}
