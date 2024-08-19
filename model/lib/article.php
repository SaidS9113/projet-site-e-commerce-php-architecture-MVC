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
function createInsertProduct(string $name, string $description, string $photo_fileName, PDO $db)
{
    // Vérifie si le produit existe déjà
    $querySelectProduct = 'SELECT id FROM product WHERE name = :name';
    $statementSelectProduct = $db->prepare($querySelectProduct);
    $statementSelectProduct->bindParam(':name', $name);
    $statementSelectProduct->execute();
    
    if ($statementSelectProduct->rowCount() > 0) {
        // Le produit existe déjà, retourne l'ID existant
        return $statementSelectProduct->fetchColumn();
    } else {
        // Le produit n'existe pas, l'insère et retourne le nouvel ID
        $queryInsertProduct = 'INSERT INTO product (name, description, photo_filename) VALUES (:name, :description, :photo_filename)';
        $statementInsertProduct = $db->prepare($queryInsertProduct);
        $statementInsertProduct->bindParam(':name', $name);
        $statementInsertProduct->bindParam(':description', $description);
        $statementInsertProduct->bindParam(':photo_filename', $photo_fileName);
        
        if ($statementInsertProduct->execute()) {
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
function createInsertProduct_stock(int $productId, array $options, PDO $db)
{
    try {
        $db->beginTransaction();

        foreach ($options as $poids => $details) {
            $price = $details['price'] ?? null;
            $quantity = isset($details['quantity']) ? (int)$details['quantity'] : 0;

            if ($price !== null && $price > 0) {
                // Vérifie si le poids existe déjà pour ce produit
                $querySelectProduct_stock = 'SELECT COUNT(*) FROM product_stock WHERE idProduct = :idProduct AND poids = :poids';
                $statementSelectProduct_stock = $db->prepare($querySelectProduct_stock);
                $statementSelectProduct_stock->bindParam(':idProduct', $productId);
                $statementSelectProduct_stock->bindParam(':poids', $poids);
                $statementSelectProduct_stock->execute();
                $exists = $statementSelectProduct_stock->fetchColumn() > 0;

                if ($exists) {
                    // Si le produit existe déjà, on ne fait rien
                    // Tu peux ajouter un message ici si tu souhaites notifier que le produit existe déjà
                    echo "Le produit avec le poids $poids existe déjà pour le produit ID $productId.\n";
                    continue; // On passe au prochain produit sans mise à jour ni insertion
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
