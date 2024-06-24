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
<h4><?= $pageTitle ?></h4>
    <main>
        <form action="/ctrl/add-article/add.php" method="post" enctype="multipart/form-data">
            <!-- Matricule -->
            <div>
                <label for="label">nom</label>
                <input type="text" name="nom" id="nom">
            </div>
            <!-- Nom -->
            <div>
                <label for="code">marque</label>
                <input type="text" name="marque" id="marque">
            </div>
            <!-- Prénom -->
            <div>
                <label for="code">price</label>
                <input type="text" name="price" id="price">
            </div>

            <div>
            <label for="file">Fichier d'image d'article</label>
            <input type="file" id="file" name="file">
        </div>
            <div class="submit">
                <button type="submit">Valider</button>
            </div>
        </form>
    </main>

   
</body>

</html>