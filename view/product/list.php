<?php
//Verifier si l'user s'est authentifié
$isLoggedIn = isset($_SESSION['user']); ?>
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
    <title>MielQualityS | Liste des produits</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
<h1 class="titleList"><?= $pageTitle ?></h1>
<section class="sectionList">
    <div class="product-list-table">
        <table>
            <thead>
                <tr>
                    <th>id</th>
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
                <?php foreach ($listProduct as $product) { ?>
                                <tr>
                <td><?= $product['id'] ?></td>
                <td><img class="image" src="../../upload/<?= $product['photo_filename'] ?>" alt="Image du produit"></td>
                <td><?= $product['name'] ?></td>
                <td><?= mb_substr($product['description'], 0, 60) . '...' ?></td>
                <td><?= $product['poids'] ?></td>
                <td><?= substr($product['price'], 0, 7) ?> €</td>

                <!-- Limiter la quantité à 100 chiffres -->
                <td><?= substr($product['quantity'], 0, 100) ?></td>

                <td>
                    <a href="/ctrl/product/update-display.php?id=<?= $product['id'] ?>&poids=<?= $product['poids'] ?>"><button class="buttonUpdate"><i class='bx bxs-wrench'></i></button></a>
                    <a href="/ctrl/product/delete.php?id=<?= $product['id'] ?>&poids=<?= $product['poids'] ?>" 
                    onclick="return confirm('Confirmer la suppression de cette option (<?= $product['poids'] ?>) ?')">
                    <button class="buttonDelete"><img class="iconeDelete" src="/asset/img/corbeille.png" alt="Supprimer"></button>
                    </a>
                </td>
            </tr>   
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="product-list-cards">
        <?php foreach ($listProduct as $product) { ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="../../upload/<?= $product['photo_filename'] ?>" alt="Image du produit">
                </div>
                <div class="product-info">
                    <h3 class="product-name"><?= $product['name'] ?></h3>
                    <p class="product-description"><?= $product['description'] ?></p>
                    <p class="product-poids">Poids : <?= $product['poids'] ?> g</p>
                    <p class="product-price">Prix : <?= $product['price'] ?> €</p>
                    <p class="product-quantity">Quantité : <?= $product['quantity'] ?></p>
                    <div class="product-actions">
                        <a href="/ctrl/product/update-display.php?id=<?= $product['id'] ?>&poids=<?= $product['poids'] ?>"><button class="buttonUpdate"><i class='bx bxs-wrench'></i></button></a>
                        <a href="/ctrl/product/delete.php?id=<?= $product['id'] ?>&poids=<?= $product['poids'] ?>" 
                           onclick="return confirm('Confirmer la suppression de cette option (<?= $product['poids'] ?>) ?')">
                           <button class="buttonDelete"><img class="iconeDelete" src="/asset/img/corbeille.png" alt="Supprimer"></button>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section class="boiteDeuxButton">
    <button class="ajoutProduit"><a href="/ctrl/product/add-display.php">Ajouter un nouveau produit</a></button>
    <button class="testAjoutPanier"><a href="/ctrl/catalogue.php">Test d'ajout au panier </a></button>
</section>

<script src="/asset/js/cart.js"></script>
</body>

</html>