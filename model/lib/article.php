<?php
/**
 * Crée un Véhicule.
 * 
 * @param string nom.
 * @param string marque.
 * @param string price.
 * @param PDO db Connexion à la BDD.
 * @return boolean Succès ou échec. 
 * 
 */

 //Function pour crée un véhicule
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