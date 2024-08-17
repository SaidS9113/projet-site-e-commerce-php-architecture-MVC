<?php
/**
 * Crée un produit dans la base de données ou récupère son ID s'il existe déjà.
 * 
 * @param string $name Nom du produit.
 * @param string $description Description du produit.
 * @param string $photo_fileName Nom du fichier de la photo du produit.
 * @param PDO $db Connexion à la base de données.
 * @return int|false Retourne l'ID du produit créé ou existant en cas de succès, false en cas d'échec.
 */
function createOrGetProductId(string $name, string $description, string $photo_fileName, PDO $db)
{
    // Vérifie si le produit existe déjà
    $checkProductQuery = 'SELECT id FROM product WHERE name = :name';
    $checkProductStatement = $db->prepare($checkProductQuery);
    $checkProductStatement->bindParam(':name', $name);
    $checkProductStatement->execute();
    
    if ($checkProductStatement->rowCount() > 0) {
        // Le produit existe déjà, retourne l'ID existant
        return $checkProductStatement->fetchColumn();
    } else {
        // Le produit n'existe pas, l'insère et retourne le nouvel ID
        $insertProductQuery = 'INSERT INTO product (name, description, photo_filename) VALUES (:name, :description, :photo_filename)';
        $insertProductStatement = $db->prepare($insertProductQuery);
        $insertProductStatement->bindParam(':name', $name);
        $insertProductStatement->bindParam(':description', $description);
        $insertProductStatement->bindParam(':photo_filename', $photo_fileName);
        
        if ($insertProductStatement->execute()) {
            return $db->lastInsertId();
        } else {
            return false;
        }
    }
}

/**
 * Crée ou met à jour les options de produit.
 * 
 * @param int $productId ID du produit pour lequel ajouter ou mettre à jour les options.
 * @param array $options Tableau associatif où la clé est la quantité et la valeur est le prix.
 * @param PDO $db Connexion à la base de données.
 * @return bool Retourne true en cas de succès, false en cas d'échec.
 */
function createOrUpdateOption(int $productId, array $options, PDO $db)
{
    try {
        $db->beginTransaction();

        foreach ($options as $quantity => $price) {
            if ($price !== null && $price > 0) {
                // Vérifie si l'option existe déjà
                $checkOptionsQuery = 'SELECT quantity FROM product_option WHERE idProduct = :idProduct AND quantity = :quantity';
                $checkOptionsStatement = $db->prepare($checkOptionsQuery);
                $checkOptionsStatement->bindParam(':idProduct', $productId);
                $checkOptionsStatement->bindParam(':quantity', $quantity);
                $checkOptionsStatement->execute();
                $exists = $checkOptionsStatement->rowCount() > 0;

                if ($exists) {
                    // Met à jour l'option existante
                    $updateOptionQuery = 'UPDATE product_option SET price = :price WHERE idProduct = :idProduct AND quantity = :quantity';
                    $updateOptionStatement = $db->prepare($updateOptionQuery);
                    $updateOptionStatement->execute([
                        ':idProduct' => $productId,
                        ':quantity' => $quantity,
                        ':price' => $price
                    ]);
                } else {
                    // Insère une nouvelle option
                    $insertOptionQuery = 'INSERT INTO product_option (idProduct, quantity, price) VALUES (:idProduct, :quantity, :price)';
                    $insertOptionStatement = $db->prepare($insertOptionQuery);
                    $insertOptionStatement->execute([
                        ':idProduct' => $productId,
                        ':quantity' => $quantity,
                        ':price' => $price
                    ]);
                }
            }
        }

        $db->commit();
        return true;
    } catch (PDOException $e) {
        $db->rollBack();
        echo 'Erreur lors de l\'insertion ou de la mise à jour des options : ' . $e->getMessage();
        return false;
    }
}