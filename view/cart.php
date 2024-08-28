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
    <title><?= $titreSite ?>| Ajout</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>

    <h1>Mon Panier</h1>
    <?php if (empty($cartItems)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <?php $sousTotal = 0; // Initialisation du sous-total ?>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Poids</th>
                    <th>Price</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item) { ?>
                    <?php 
            // Calcul du total pour chaque produit et ajout au sous-total
            $totalProduit = $item['price'] * $item['quantity'];
            $sousTotal += $totalProduit; 
            ?>
                    <tr>
                        <td><img class="image" src="../../upload/<?= $item['photo_filename'] ?>" alt=""></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['description'] ?></td>
                        <td><?= $item['poids'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>
    <a href="/ctrl/product/delete.php?id=<?= $product['id'] ?>&poids=<?= $product['poids'] ?>" 
       onclick="return confirm('Confirmer la suppression de cette option (<?= $product['poids'] ?>) ?')">
       <button class="buttonDelete">
           <img class="iconeCorbeille" src="/asset/img/corbeille.png" alt="">
       </button>
    </a>
</td>
                    </tr>
                <?php } ?>
            </tbody>
          
        </table>
        
                </main>
                <p><strong>Sous-total:</strong> <?= number_format($sousTotal, 2) ?> €</p>
    <a href="/ctrl/checkout.php">Procéder au paiement</a>
<?php endif; ?>

<p><a href="/ctrl/catalog.php">Retourner au catalogue</a></p>

</body>
</html>