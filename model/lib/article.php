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
function create(string $nom, string $marque, string $price, string $fileName, PDO $db) : bool
{
    // Prépare la requête
    $query = 'INSERT INTO vehicule (nom, marque, price, photo_filename) VALUES (:nom, :marque, :price, :photo_filename)';
    $statement = $db->prepare($query);
    $statement->bindParam(':nom', $nom);
    $statement->bindParam(':marque', $marque);
    $statement->bindParam(':price', $price);
    $statement->bindParam(':photo_filename', $fileName);


    // Exécute la requête
    $successOrFailure = $statement->execute();

    return $successOrFailure;
}