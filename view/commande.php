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
    <title>MielQualityS | Commande</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>

    <h1 class="titleList">Liste des Commandes</h1>
    <section class="sectionList">
        <div class="product-list-table">
            <table>
                <thead>
                    <tr>
                        <th>idUser</th>
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Adresse</th>
                        <th>Code postal</th>
                        <th>Commande</th>
                        <th>Poids</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listCommande as $commande) { ?>
                        <tr>
                            <td><?= $commande['idUser'] ?></td>
                            <td><?= mb_substr($commande['email'], 0, 40)  ?></td>
                            <td><?= mb_substr($commande['nom'], 0, 27)  ?></td>
                            <td><?= mb_substr($commande['prenom'], 0, 27)  ?></td>
                            <td><?= mb_substr($commande['adresse'], 0, 27)  ?></td>
                            <td><?= mb_substr($commande['code_postal'], 0, 27)  ?></td>
                            <td><?= mb_substr($commande['name'], 0, 27)  ?></td>
                            <td><?= $commande['poids'] ?></td>
                            <td><?= substr($commande['quantity'], 0, 3) ?></td>
                            
                        <td>
                            <?php 
                            $formattedTotal = number_format($commande['total'], 2); // Formater avec 2 décimales
                            echo (strlen($formattedTotal) > 7) ? substr($formattedTotal, 0, 7) : $formattedTotal; 
                            ?> €
                        </td>

                            <td><?= $commande['status'] ?></td>
                            <td><?= $commande['order_date'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="product-list-cards">
            <?php foreach ($listCommande as $commande) { ?>
                <div class="product-card">
                    <div class="product-info">
                        <p><strong>idUser :</strong> <?= $commande['idUser'] ?></p>
                        <p><strong>Email :</strong> <?= $commande['email'] ?></p>
                        <p><strong>Email :</strong> <?= $commande['nom'] ?></p>
                        <p><strong>Email :</strong> <?= $commande['prenom'] ?></p>
                        <p><strong>Email :</strong> <?= $commande['adresse'] ?></p>
                        <p><strong>Email :</strong> <?= $commande['code_postal'] ?></p>
                        <p><strong>Commande :</strong> <?= $commande['name'] ?></p>
                        <p><strong>Poids :</strong> <?= $commande['poids'] ?> g</p>
                        <p><strong>Quantité :</strong> <?= $commande['quantity'] ?></p>
                        <p><strong>Total :</strong> <?= $commande['total'] ?> €</p>
                        <p><strong>Statut :</strong> <?= $commande['status'] ?></p>
                        <p><strong>Date :</strong> <?= $commande['order_date'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php if (isset($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- Formulaire pour vider les tables commande_info et commande_product -->
    <form action="/ctrl/commande.php" method="post">
        <input type="hidden" name="action" value="clear">
        <button type="submit">Vider les tables commande_info et commande_product</button>
    </form>
    <script src="/asset/js/cart.js"></script>
</body>

</html>