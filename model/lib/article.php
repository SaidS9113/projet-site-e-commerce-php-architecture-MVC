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
 * @param array $options Tableau associatif où la clé est le poids et la valeur est le prix.
 * @param PDO $db Connexion à la base de données.
 * @return bool Retourne true en cas de succès, false en cas d'échec.
 */
function createOrUpdateOption(int $productId, array $options, PDO $db)
{
    try {
        $db->beginTransaction();

        foreach ($options as $poids => $details) {
            $price = $details['price'] ?? null;
            $quantity = isset($details['quantity']) ? (int)$details['quantity'] : 0;

            // Debugging: Affiche les valeurs avant l'exécution des requêtes
            echo "Poids: $poids, Prix: $price, Quantité: $quantity\n";

            if ($price !== null && $price > 0) {
                // Vérifie si le poids existe déjà
                $checkOptionsQuery = 'SELECT COUNT(*) FROM product_stock WHERE idProduct = :idProduct AND poids = :poids';
                $checkOptionsStatement = $db->prepare($checkOptionsQuery);
                $checkOptionsStatement->bindParam(':idProduct', $productId);
                $checkOptionsStatement->bindParam(':poids', $poids);
                $checkOptionsStatement->execute();
                $exists = $checkOptionsStatement->fetchColumn() > 0;

                if ($exists) {
                    // Met à jour du poids existant
                    $updateOptionQuery = 'UPDATE product_stock SET price = :price, quantity = :quantity WHERE idProduct = :idProduct AND poids = :poids';
                    $updateOptionStatement = $db->prepare($updateOptionQuery);
                    $updateOptionStatement->bindParam(':idProduct', $productId);
                    $updateOptionStatement->bindParam(':poids', $poids);
                    $updateOptionStatement->bindParam(':price', $price);
                    $updateOptionStatement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                    $updateOptionStatement->execute();
                } else {
                    // Insère une nouvelle entrée
                    $insertOptionQuery = 'INSERT INTO product_stock (idProduct, poids, price, quantity) VALUES (:idProduct, :poids, :price, :quantity)';
                    $insertOptionStatement = $db->prepare($insertOptionQuery);
                    $insertOptionStatement->bindParam(':idProduct', $productId);
                    $insertOptionStatement->bindParam(':poids', $poids);
                    $insertOptionStatement->bindParam(':price', $price);
                    $insertOptionStatement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                    $insertOptionStatement->execute();
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
