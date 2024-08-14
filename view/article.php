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
    <title><?= $titreSite ?>| Boutique</title>
</head>
<body class="bodyArticle">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>

    <?php
// Définir les IDs des véhicules que vous voulez afficher
$selectedIds = [5 , 7, 4]; // Remplacez par les IDs des véhicules que vous voulez afficher

// Filtrer la liste des véhicules pour ne garder que ceux avec les IDs spécifiés
$filteredProducts = array_filter($listProduct, function($product) use ($selectedIds) {
    return in_array($product['id'], $selectedIds);
});
?>

<h1 class="title-product"><?= $pageTitle ?></h1>

<section class="container-product">
<?php foreach ($filteredProducts as $product) { ?>
    <article class="product">
        <a href="/ctrl/add-commentaire/pageDetailDisplayList.php"><img class="image" src="../upload/<?= $product['photo_filename'] ?>" alt=""></a>
        <a href="/ctrl/add-commentaire/pageDetail.php"><h3 class="title"><?= $product['name'] ?></h3></a>
        <span class="price"><?= $product_option['price'] ?>€</span>
    </article>
<?php } ?>
    </article>
    </section>
</body>
</html>