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

    <form class="formUpdate" action="/ctrl/profil-info/update.php" method="post">
    <!-- ID du produit -->
    <input type="hidden" name="id" value="<?= $userInfo['id'] ?? '' ?>">

    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= htmlspecialchars($userInfo['email'] ?? '', ENT_QUOTES) ?>" required>
    </div>

    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <textarea name="password" id="password" required><?= htmlspecialchars($userInfo['password'] ?? '', ENT_QUOTES) ?></textarea>
    </div>

    <!-- Bouton de soumission -->
    <div class="submit">
        <button type="submit">Modifier</button>
    </div>
</form>



    </main>

</body>

</html>