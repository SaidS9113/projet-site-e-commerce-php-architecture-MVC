<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main>
    <form action="/ctrl/uploadImage.php" method="post" enctype="multipart/form-data">
        <!-- fichier à 'uploader' -->
        <div>
            <label for="file">Fichier d'image d'article</label>
            <input type="file" id="file" name="file">
        </div>
        <div>
            <button type="submit">Valider</button>
        </div>
    </form>
</main>
</body>
</html>