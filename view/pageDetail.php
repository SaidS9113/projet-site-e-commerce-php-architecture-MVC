<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;
                1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../asset/css/style.css">
    <title><?= $titreSite ?>| Article</title>
</head>
</head>

<body class="bodyArticleDetail">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/headerBootstraps.php' ?>
    <?php
    // Définir les IDs des véhicules que vous voulez afficher
    $selectedIds = [4]; // Remplacez par les IDs des véhicules que vous voulez afficher

    // Filtrer la liste des véhicules pour ne garder que ceux avec les IDs spécifiés
    $filteredProducts = array_filter($listProduct, function ($product) use ($selectedIds) {
        return in_array($product['id'], $selectedIds);
    });
    ?>
    <section class="container sproduct my-5 pt-0">
        <?php foreach ($filteredProducts as $product) { ?>
            <div style="border-bottom: 2px solid #fff" class="row mt-5">
                <div class="col-lg-5 col-md-12 col-12">
                    <img class="img-fluid w-100" src="../../upload/<?= $vehicule['photo_filename'] ?>" class="small-img" alt="">

                    <div class="small-img-group">
                        <div class="small-img-col">
                            <img src="" width="100%" class="small-img" alt="">
                        </div>
                        <div class="small-img-col">
                            <img src="" width="100%" class="small-img" alt="">
                        </div>
                        <div class="small-img-col">
                            <img src="" width="100%" class="small-img" alt="">
                        </div>
                        <div class="small-img-col">
                            <img src="" width="100%" class="small-img" alt="">
                        </div>
                    </div>
                </div>



                <div class="col-lg-6 col-md-12 col-12">
                    <h6 class="arboPageDetail">Accueil / Véhicule / McLaren</h6>
                    <h3 class="product-title"><?= $product['nom'] ?></h3>
                    <h5 class="price" ><?= $product['price'] ?>€</h5>

                </div>

                <?php } ?>

            </div>
            <h4 class="mt-5 mb-5">Commentaire</h4>
            
            <form class="formCommentaire" action="/ctrl/add-commentaire/add.php" method="post" enctype="multipart/form-data">
            <div class="boiteSaisieCommentaire">
                <label for="label">Donnez votre avis sur le véhicule</label>
                
                <textarea  type="text" name="contenu" id="contenu" cols="30" rows="10" placeholder="Veuillez saisir un commentaire"></textarea>
            </div>
            <div class="boiteAjtCommentaire">
                <button type="submit">Valider</button>
            </div>

            </form>
            <?php foreach ($listAvis as $avis) { ?>
            <div class="container-commentaire">
                <h5 class="user-commentaire"><?=$avis ['idUser']?> <span class="date-commentaire"> <?= $avis['date'] ?></span><span></span></h5>
                <p class="commentaire"><?= $avis['content'] ?></p>
            </div>
        <?php } ?>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>

</html>