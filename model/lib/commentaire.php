<?php
/**
 * Crée un Marin.
 * 
 * @param string matricule Matricule.
 * @param string nom Nom de famille, corse de préférence.
 * @param string prenom Prénom.
 * @param PDO db Connexion à la BDD.
 * @return boolean Succès ou échec. 
 * 
 */
 //Function pour crée un véhicule
function create(string $contenu, string $date, $idUser, PDO $db) : bool
{
    // Prépare la requête
    $query = 'INSERT INTO commentaire (contenu, date, idUser) VALUES (:contenu, :date, :idUser)';
    $statement = $db->prepare($query);
    $statement->bindParam(':contenu', $contenu);
    $statement->bindParam(':date', $date);
    $statement->bindParam(':idUser', $idUser);
    // Exécute la requête
    $successOrFailure = $statement->execute();

    return $successOrFailure;
}