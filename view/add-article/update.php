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
    <title><?= $titreSite ?>| Modifier</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
    <main>

    <form class="formUpdate" action="/ctrl/add-article/update.php" method="post">
    <!-- ID du produit -->
    <input type="hidden" name="id" value="<?= $product['id'] ?? '' ?>">

    <!-- Nom -->
    <div>
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($productInfo['name'] ?? '', ENT_QUOTES) ?>" required>
    </div>

    <!-- Description -->
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($productInfo['description'] ?? '', ENT_QUOTES) ?></textarea>
    </div>

    <!-- Poids -->
    <div>
        <label for="poids">Poids</label>
        <select name="poids" id="poids" required>
            <?php foreach ($stockInfo as $stock): ?>
                <option value="<?= htmlspecialchars($stock['poids'], ENT_QUOTES) ?>" 
                    <?= isset($productInfo['poids']) && $productInfo['poids'] === $stock['poids'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($stock['poids'], ENT_QUOTES) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Prix -->
    <div>
        <label for="price">Prix</label>
        <input type="text" name="price" id="price" value="<?= htmlspecialchars($stockInfo[0]['price'] ?? '', ENT_QUOTES) ?>" required>
    </div>

    <!-- Quantité -->
    <div>
        <label for="quantity">Quantité</label>
        <input type="number" name="quantity" id="quantity" value="<?= htmlspecialchars($stockInfo[0]['quantity'] ?? '', ENT_QUOTES) ?>" required>
    </div>

    <!-- Bouton de soumission -->
    <div class="submit">
        <button type="submit">Modifier</button>
    </div>
</form>



    </main>

</body>

</html>