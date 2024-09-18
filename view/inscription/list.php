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
    <title>MielQualityS | Liste utilisateurs</title>
</head>
<body>
    <!---------Barre de promotion----------->
<div class="promo">
    <p>Livraison gratuite à partir de 50€</p>
</div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>

    <h1 class="titleList">Liste des utilisateurs</h1>

    <section class="sectionList">
        <div class="product-list-table">
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>idRole</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listUser as $user) { ?>
                        <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['idRole'] ?></td>
                    <td><?= mb_substr($user['email'], 0, 40) . (strlen($user['email']) > 40 ? '...' : '') ?></td>
                    <td><?= mb_substr($user['password'], 0, 70) . (strlen($user['password']) > 70 ? '...' : '') ?></td>
                    <td>
                        <a href="/ctrl/inscription/delete.php?id=<?= $user['id'] ?>" 
                        onclick="return confirm('Confirmer la suppression de cet utilisateur (ID: <?= $user['id'] ?>) ?')">
                            <button class="buttonDelete">
                                <img class="iconeCorbeille" src="/asset/img/corbeille.png" alt="Supprimer">
                            </button>
                        </a>
                    </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="product-list-cards">
            <?php foreach ($listUser as $user) { ?>
                <div class="product-card">
                    <div class="product-info">
                        <p><strong>ID :</strong> <?= $user['id'] ?></p>
                        <p><strong>ID Role :</strong> <?= $user['idRole'] ?></p>
                        <p><strong>Email :</strong> <?= $user['email'] ?></p>
                        <p><strong>Password :</strong> <?= $user['password'] ?></p>
                        <div class="product-actions">
                            <a href="/ctrl/inscription/delete.php?id=<?= $user['id'] ?>" 
                               onclick="return confirm('Confirmer la suppression de cet utilisateur (ID: <?= $user['id'] ?>) ?')">
                                <button class="buttonDelete">
                                    <img class="iconeCorbeille" src="/asset/img/corbeille.png" alt="Supprimer">
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <script src="/asset/js/cart.js"></script>
</body>

</html>