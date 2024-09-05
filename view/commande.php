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

    <h1>Commmande des clients</h1>
   

    <main>
        <table>
            <thead>
                <tr>
                    <th>idUser</th>
                    <th>Email</th>
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
                        <td><?= $commande['idUser'] ?> </td>
                        
                        <td><?= $commande['email'] ?></td>
                        <td><?= $commande['name'] ?></td>
                        <td><?= $commande['poids'] ?></td>
                        <td><?= $commande['quantity'] ?></td>
                        <td><?= $commande['total'] ?></td>
                        <td><?= $commande['status'] ?></td>
                        <td><?= $commande['order_date'] ?></td>
                        <td>
                        
</td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
                </main>

                <?php if (isset($message)): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>


<!-- Formulaire pour vider les tables commande_info et commande_product -->
<form action="/ctrl/commande.php" method="post">
    <input type="hidden" name="action" value="clear">
    <button type="submit">Vider les tables commande_info et commande_product</button>
</form>
</body>

</html>