<?php
// Vérifier si l'utilisateur est authentifié
$isLoggedIn = isset($_SESSION['user']);

// Récupérer les informations de l'URL (poids, prix, quantité) avec $_GET
$productInfo['poids'] = $_GET['poids'] ?? '';
$productInfo['price'] = $_GET['price'] ?? '';
$productInfo['quantity'] = $_GET['quantity'] ?? '';
?>

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
    <title>MielQualityS | Modifier le produit</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php'; ?>
    <main>

        <form class="formUpdate" action="/ctrl/product/update.php" method="post">
            <!-- ID du produit -->
            <input type="hidden" name="id" value="<?= $productInfo['id'] ?? '' ?>">
            <!-- Nom -->
            <div>
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" value="<?= $productInfo['name'] ?? '' ?>" required>
            </div>

            <!-- Description -->
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" required><?= $productInfo['description'] ?? '' ?></textarea>
            </div>

            
            <!-- Poids -->
<div>
    <label for="poids">Poids</label>
    <input type="hidden" name="poids" id="poids" value="<?= $productInfo['poids'] ?>">
    <p class="poids"><?= $productInfo['poids'] ?></p> <!-- Affichage en texte -->
</div>


<!-- Boucle foreach pour récupérer uniquement les informations selon le poids -->
<?php foreach ($stockInfo as $info) {
                // Comparer le poids du produit avec celui du stock
                if ($info['poids'] == $productInfo['poids']) { ?>
                    <!-- Prix -->
                    <div>
                        <label for="price">Prix</label>
                        <input type="text" name="price" id="price" value="<?= $info['price'] ?>" required>
                    </div>

                    <!-- Quantité -->
                    <div>
                        <label for="quantity">Quantité</label>
                        <input type="number" name="quantity" id="quantity" value="<?= $info['quantity'] ?>" required>
                    </div>
                <?php }
            } ?>

            <!-- Bouton de soumission -->
            <div class="submit">
                <button type="submit">Modifier</button>
            </div>
        </form>

    </main>
    <script src="/asset/js/cart.js"></script>
</body>

</html>
