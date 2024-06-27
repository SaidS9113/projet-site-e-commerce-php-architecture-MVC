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
    <title><?= $titreSite ?>| Panier</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
    <main>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Marque</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($listVehicule as $vehicule) { ?>
                    <tr>
                        <td> <?= $vehicule['id'] ?> </td>
                        <td><?= $vehicule['nom'] ?></td>
                        <td><?= $vehicule['marque'] ?></td>
                        <td><?= $vehicule['price'] ?></td>
                        <td>
                            <a href="/ctrl/add-article/delete.php?id=<?= $vehicule['id'] ?>" onclick="return confirm('Confirmer la suppression')"><button class="buttonDelete"><img class="iconeCorbeille" src="/asset/img/corbeille (3).png" alt=""></button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                </main>
</body>

</html>