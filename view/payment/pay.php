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
    <title>MielQualityS | Pay</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
    <h1>Formulaire de Paiement</h1>
<!-- Affichage du statut du paiement si défini -->
<?php if (isset($paymentSuccess)) : ?>
    <?php if ($paymentSuccess) : ?>
        <p class="success">Le paiement a été effectué avec succès. Merci pour votre commande !</p>
    <?php else : ?>
        <p class="error">Échec du paiement. Veuillez réessayer.</p>
    <?php endif; ?>
<?php endif; ?>

<form class="formPay" action="?action=processPayment" method="post">
<?php if ($idRole !== 10 && $idRole !== 20): ?>
        <!-- Affichez ces champs uniquement pour les utilisateurs connectés avec un rôle différent de 10 ou 20 -->
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom">

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom">

        <label for="adress">Adresse :</label>
        <input type="text" id="adresse" name="adresse">

        <label for="code_posta">Code Postal :</label>
        <input type="text" id="code_postal" name="code_postal">
    <?php endif; ?>


    <label for="cardNumber">Numéro de Carte :</label>
    <input type="text" id="cardNumber" name="cardNumber" required>

    <label for="cardName">Nom sur la Carte :</label>
    <input type="text" id="cardName" name="cardName" required>

    <label for="expiryDate">Date d'Expiration (MM/AA) :</label>
    <input type="text" id="expiryDate" name="expiryDate" required>

    <label for="cvv">CVV :</label>
    <input type="text" id="cvv" name="cvv" required>



    <button type="submit">Procéder au Paiement</button>
</form>

<script src="/asset/js/cart.js"></script>
</body>
</html>