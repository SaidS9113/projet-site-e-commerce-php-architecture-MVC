<?php
//Verifier si l'user s'est authentifié
$sessionId = isset($_SESSION['user']); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;
                1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../asset/css/style.css">
    <title>MielQualityS | Panier</title>
</head>
<body>
    <!---------Barre de promotion----------->
<div class="promo">
    <p>Livraison gratuite à partir de 50€</p>
</div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>

    <h1 class="titleList">Mon Panier</h1>

    <?php if (empty($cartItems)): ?>
        <p class="cartVide">Votre panier est vide.</p>
    <?php else: ?>
        <?php $sousTotal = 0; ?>
        <section class="sectionList">
            <!-- Version Tableau -->
            <div class="product-list-table">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Poids</th>
                            <th>Price</th>
                            <th>Quantité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item) { ?>
                            <?php 
                            $totalProduit = $item['price'] * $item['quantity'];
                            $sousTotal += $totalProduit; 
                            ?>
                         <tr>
                                <td><img class="image" src="../../upload/<?= $item['photo_filename'] ?>" alt=""></td>
                                <td><?= mb_substr($item['name'], 0, 25)  ?></td>
                                <td><?= mb_substr($item['description'], 0, 60) ?></td>
                                <td><?= $item['poids'] ?></td>

                                <!-- Limiter le prix à 7 caractères -->
                                <td>
                                    <?php 
                                    $formattedPrice = number_format($item['price'], 2); // Formater le prix avec 2 décimales
                                    echo (strlen($formattedPrice) > 7) ? substr($formattedPrice, 0, 7) : $formattedPrice; 
                                    ?> €
                                </td>

                                <td><?= $item['quantity'] ?></td>
                                <td>
                                    <a href="/ctrl/cart/delete.php?id=<?= $item['idProduct'] ?>&poids=<?= $item['poids'] ?>" 
                                    onclick="return confirm('Confirmer la suppression de cette option (<?= $item['poids'] ?>) ?')">
                                    <button class="buttonDelete"><img class="iconeCorbeille" src="/asset/img/corbeille.png" alt="Supprimer"></button>
                                    </a>
                                </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Version Cartes -->
            <div class="product-list-cards">
                <?php foreach ($cartItems as $item) { ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="../../upload/<?= $item['photo_filename'] ?>" alt="Image du produit">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><?= $item['name'] ?></h3>
                            <p class="product-description"><?= $item['description'] ?></p>
                            <p class="product-poids">Poids : <?= $item['poids'] ?> g</p>
                            <p class="product-price">Prix : <?= $item['price'] ?> €</p>
                            <p class="product-quantity">Quantité : <?= $item['quantity'] ?></p>
                            <div class="product-actions">
                                <a href="/ctrl/cart/delete.php?id=<?= $item['idProduct'] ?>&poids=<?= $item['poids'] ?>" 
                                   onclick="return confirm('Confirmer la suppression de cette option (<?= $item['poids'] ?>) ?')">
                                   <button class="buttonDelete"><img class="iconeCorbeille" src="/asset/img/corbeille.png" alt="Supprimer"></button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
<div class="boiteActionCart">
            <p class="sous-total"><strong>Sous-total:</strong> <?= number_format($sousTotal, 2) ?> €</p>
            <p class="procedePay"><a href="/ctrl/payment/pay.php">Procéder au paiement</a></p>
       
    <p class="exitProduct"><a href="/ctrl/catalogue.php">Retourner au catalogue</a></p>
    </div>
    </section>
    <?php endif; ?>
    <script src="/asset/js/cart.js"></script>
</body>
</html>