<?php

// Liste les Marins

// function list($id, $matricule, $nom, $prenom, PDO $db) : bool
// {
//     // Prépare la requête
// $query = ' SELECT marin.id, marin.matricule, marin.nom, marin.prenom';
// $query .= ' FROM marin';
// $statement = $dbConnection->prepare($query);

// // Exécute la requête
// $successOrFailure = $statement->execute();
// $listMarin = $statement->fetchAll(PDO::FETCH_ASSOC);
// return $successOrFailure;
// }
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
function create(string $matricule, string $nom, string $prenom, PDO $db) : bool
{
    // Prépare la requête
    $query = 'INSERT INTO marin (matricule, nom, prenom) VALUES (:matricule, :nom, :prenom)';
    $statement = $db->prepare($query);
    $statement->bindParam(':matricule', $matricule);
    $statement->bindParam(':nom', $nom);
    $statement->bindParam(':prenom', $prenom);

    // Exécute la requête
    $successOrFailure = $statement->execute();

    return $successOrFailure;
}