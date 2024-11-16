<?php
//Verifier si l'user s'est authentifié
$isLoggedIn = isset($_SESSION['user']); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;
                1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../asset/css/style.css">
    <title>MielQualityS | Page-detail-produit</title>
</head>
</head>

<body class="bodyArticleDetail">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
    <section class="container sproduct my-5 pt-0">
    <div style="border-bottom: 2px solid #fff" class="row mt-5">
        <div class="col-lg-5 col-md-12 col-12">
            <img class="img-fluid w-100" src="../../upload/<?= $product['photo_filename'] ?>" alt="">
            <div class="small-img-group">
                <!-- Small images -->
                <div class="small-img-col">
                    <img src="" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="" width="100%" class="small-img" alt="">
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <h6 class="arboPageDetail">Accueil / Page détail / <?= $product['name'] ?></h6>
            <h3 class="product-title"><?= $product['name'] ?></h3>
            <p class="description"><?= $product['description'] ?></p>

    <!-- Formulaire pour sélectionner le poids -->
<form class="formPoids" action="" method="get">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <label for="poids">Choisissez le poids :</label>
    <select name="poids" id="poids" onchange="this.form.submit()">
        <?php foreach ($productPoids as $poids): ?>
            <option value="<?= $poids['poids'] ?>"
                    <?= (isset($_GET['poids']) && $_GET['poids'] == $poids['poids']) ? 'selected' : '' ?>
                    data-price="<?= $poids['price'] ?>"
                    data-quantity="<?= $poids['quantity'] ?>">
                <?= $poids['poids'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<!-- Affichage des informations du produit basé sur la sélection -->
<p id="price-display">Prix: <?= number_format($productPoids[0]['price'], 2) ?>€</p>
<p id="quantity-display">Quantité disponible: <?= $productPoids[0]['quantity'] ?></p>



<!-- Formulaire d'ajout au panier -->
<form action="/ctrl/cart/add.php" method="get" id="add-to-cart-form">
    <!-- Champs cachés pour envoyer les données -->
    <input type="hidden" name="idProduct" value="<?= $_GET['id'] ?? $product['id'] ?>">
    <input type="hidden" name="poids" value="<?= $_GET['poids'] ?? $productPoids[0]['poids'] ?>">
    <input type="hidden" name="price" value="<?= $_GET['price'] ?? $productPoids[0]['price'] ?>">
    <!-- Identifiant de la session pour les utilisateurs non connectés -->
    <input type="hidden" name="sessionId" value="<?= $_GET['sessionId'] ?? $sessionId['sessionId'] ?>">

    <!-- Quantité à ajouter au panier -->
    <label for="quantity">Quantité :</label>
    <input type="number" id="quantity" name="quantity" value="1" min="1" />
    <span id="stock-message"></span>

    <!-- Bouton d'ajout au panier -->
    <button type="submit" id="add-to-cart-button">Ajouter au panier</button>
</form>

<?php
// Affichage du message flash
if (isset($_SESSION['flash_message'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['flash_message'] . '</div>';
    unset($_SESSION['flash_message']); // Supprimer le message après affichage
}
?>

<script>
function updateProductInfo() {
    var select = document.getElementById('poids');
    var selectedOption = select.options[select.selectedIndex];
    var quantity = parseInt(selectedOption.getAttribute('data-quantity'), 10);
    
    var priceDisplay = document.getElementById('price-display');
    var quantityDisplay = document.getElementById('quantity-display');
    var stockMessage = document.getElementById('stock-message');
    var quantityInput = document.getElementById('quantity');
    var addToCartButton = document.getElementById('add-to-cart-button');

    // Update price and quantity display
    priceDisplay.textContent = 'Prix: ' + selectedOption.getAttribute('data-price') + '€';
    
    if (quantity > 0) {
        quantityDisplay.textContent = 'Quantité disponible: ' + quantity;
        quantityInput.disabled = false;
        addToCartButton.disabled = false;
        stockMessage.textContent = '';
    } else {
        quantityDisplay.textContent = 'Rupture de stock';
        quantityDisplay.style.color = 'red';
        quantityInput.disabled = true;
        addToCartButton.disabled = true;
     
    }
}

// Initialize the product info when the page loads
document.addEventListener('DOMContentLoaded', updateProductInfo);
</script>


            </div>
            <h2 class="titreFormAvis">Commentaire</h2>
            
<form class="formCommentaire" action="/ctrl/avis/add.php" method="post" enctype="multipart/form-data">
    <div class="boiteSaisieCommentaire">
        <label for="contenu">Donnez votre avis sur le produit</label>
        <textarea name="content" id="contenu" cols="30" rows="10" placeholder="Veuillez saisir un commentaire"></textarea>
    </div>
    
    <!-- Champ caché pour envoyer l'id du produit -->
    <input type="hidden" name="idProduct" value="<?= $product['id'] ?>">
    <input type="hidden" name="poids" value="<?= $productPoids[0]['poids'] ?>">
    <input type="hidden" name="price" value="<?= $productPoids[0]['price'] ?>">

    <!-- Champ caché pour envoyer l'id de l'utilisateur (si l'utilisateur est connecté, sinon à gérer en back-end) -->
    <input type="hidden" name="idUser" value="<?= $idUser ?>">

    <div class="boiteAjtCommentaire">
        <button type="submit">Valider</button>
    </div>
</form>

<?php foreach ($listAvis as $avis) { ?>
    <div class="container-commentaire">
        <h5 class="user-commentaire">
            <!-- Affichage de l'email ou du nom de l'utilisateur qui a posté l'avis -->
            <?= $avis['nom'] ?>  <?= $avis['prenom'] ?> 
            <span class="date-commentaire"><?= $avis['date'] ?></span>
        </h5>
        <p class="commentaire"><?= $avis['content'] ?></p>
    </div>
    <form class="formCommentaire" action="/ctrl/avis/delete.php" method="post" enctype="multipart/form-data">
    <!-- Champs cachés pour les informations du produit -->
    <input type="hidden" name="idProduct" value="<?= $product['id'] ?>">
    <input type="hidden" name="poids" value="<?= $productPoids[0]['poids'] ?>">
    <input type="hidden" name="price" value="<?= $productPoids[0]['price'] ?>">
    
    <!-- Champ caché pour l'identifiant de l'avis à supprimer -->
    <input type="hidden" name="idAvis" value="<?= $avis['id'] ?>">

    <!-- Affichage du bouton de suppression si l'utilisateur est autorisé -->
    <?php if ($isLoggedIn && ($_SESSION['user']['idRole'] == '10' || $avis['idUser'] == $_SESSION['user']['id'])): ?>
        <button class="buttonDelete" type="submit" onclick="return confirm('Confirmer la suppression de cet avis ?');">
            <img class="iconeCorbeille" src="/asset/img/corbeille.png" alt="Supprimer">
        </button>
    <?php endif; ?>
</form>

<?php } ?>

    </section>
    <script src="/asset/js/cart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="/asset/js/selectedOption.js"></script>
</body>

</html>
