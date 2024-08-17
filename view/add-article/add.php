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
    <title><?= $titreSite ?>| Ajout</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
<h4 class="titleAjtVehicule"><?= $pageTitle ?></h4>
    <main class="mainAjtVehicule">
        <form class="formAjtVehicule" action="/ctrl/add-article/add.php" method="post" enctype="multipart/form-data">
             <!-- Nom -->
            <div class="boiteAjtVehicule">
                <label for="label">Nom</label>
                <input type="text" name="name" id="name">
            </div>
        <!-- Matricule -->
            <div class="boiteAjtVehicule">
                <label for="code">Description</label>
                <input type="text" name="description" id="description">
            </div>
            <!-- Price -->
            <div class="boiteAjtVehicule">
    <label for="add_250g">
        <input type="checkbox" id="add_250g" name="add_250g" value="250g">
        Ajouter 250g
    </label>
    <label for="price_250g">Prix pour 250g :</label>
    <input type="text" id="price_250g" name="price_250g" step="0.01">

    <label for="add_500g">
        <input type="checkbox" id="add_500g" name="add_500g" value="500g">
        Ajouter 500g
    </label>
    <label for="price_500g">Prix pour 500g :</label>
    <input type="text" id="price_500g" name="price_500g" step="0.01">

    <label for="add_1kg">
        <input type="checkbox" id="add_1kg" name="add_1kg" value="1kg">
        Ajouter 1kg
    </label>
    <label for="price_1kg">Prix pour 1kg :</label>
    <input type="text" id="price_1kg" name="price_1kg" step="0.01">
</div>
         <!-- Update une image -->
            <div class="boiteAjtVehicule">
            <label for="file">Fichier d'image d'article</label>
            <input type="file" id="file" name="file">
        </div>
            <div class="boiteAjtVehicule">
                <button type="submit">Valider</button>
            </div>
        </form>
    </main>

   
</body>

</html>