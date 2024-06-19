<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>

<body>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/_header.php' ?>

    <main>

        <table>


            <!-- Entêtes de colonne écrites 'en dur' -->
            <thead>
                <tr>
                    <th>id</th>
                    <th>matricule</th>
                    <th>nom</th>
                    <th>prénom</th>
                    <th>actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($listMarin as $marin) { ?>

                    <tr>

                        <td> <?= $marin['id'] ?> </td>
                        <td><?= $marin['matricule'] ?></td>
                        <td><?= $marin['nom'] ?></td>
                        <td><?= $marin['prenom'] ?></td>
                        <td>
                            <a href="/ctrl/marin/update-display.php?id=<?= $marin['id'] ?>"><button class="buttonUpdate"><img class="iconeCorbeille" src="/asset/img/editer.png" alt=""></button></a>
                            <a href="/ctrl/marin/delete.php?id=<?= $marin['id'] ?>" onclick="return confirm('Confirmer la suppression')"><button class="buttonDelete"><img class="iconeCorbeille" src="/asset/img/corbeille.png" alt=""></button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/_footer.php' ?>
</body>

</html>