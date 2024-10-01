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
    <link rel="stylesheet" href="../asset/css/style.css">
    <title>MielQualityS | Boutique</title>
</head>
<body class="bodyArticle">
    <!---------Barre de promotion----------->
<div class="promo">
    <p>Livraison gratuite à partir de 50€</p>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
<section class="products">
        <h2>NOS PRODUITS</h2>
        <div>
        <?php foreach ($listProduct as $product) { ?>
            <figure>
            <a href="<?= $productUrls[$product['id']] ?>"><img class="image" src="../upload/<?= $product['photo_filename'] ?>" alt=""></a>
            <a href="<?= $productUrls[$product['id']] ?>">
                <h3 class="title"><?= mb_substr($product['name'], 0, 26)  ?></h3>
            </a>
            <p class="description"><?= substr($product['description'], 0, 15) ?></p>
            <span class="price"><?= substr($product['price'], 0, 7) ?>€</span>
            </figure>
            <?php } ?>

            
        </div>
    </section>
    <?php include 'partial/footer.php'; ?>
    <script src="/asset/js/cart.js"></script>
</body>
</html>