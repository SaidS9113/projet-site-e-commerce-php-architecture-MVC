<?php
//Verifier si l'user s'est authentifié
$isLoggedIn = isset($_SESSION['user']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <title><?=$titreSite?></title>
</head>
<body class="bodyAccueil" id="">
    <!---------Barre de promotion----------->
<div class="promo">
    <p>Livraison gratuite à partir de 50€</p>
</div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
 <!--------Accueil----------->
 <section class="accueil">
        <p>MIELS D'EXCEPTIONS ET 100% NATUREL</p>
        <a class="btn" href="">Découvrir</a>
    </section>
    <!--------Partie pour les produits----------->
    <section class="products">
        <h2>NOS PRODUITS</h2>
        <div>
        <?php 
$count = 0; // Initialiser un compteur

foreach ($listProduct as $product) { 
    if ($count >= 4) { // Vérifier si le nombre de produits affichés est 4
        break; // Sortir de la boucle si on a déjà affiché 4 produits
    }
?>
    <figure>
        <a href="<?= $productUrls[$product['id']] ?>"><img class="image" src="../upload/<?= $product['photo_filename'] ?>" alt=""></a>
        <a href="<?= $productUrls[$product['id']] ?>"><h3 class="title"><?= $product['name'] ?></h3></a>
        <p class="description"><?= substr($product['description'], 0, 25)  ?></p>
        <span class="price"><?= $product['price'] ?>€</span>
    </figure>
<?php 
    $count++; // Incrémenter le compteur après chaque produit affiché
} 
?>
  
        </div>
    </section>
    <div class="boiteVoirPlus">
    <a href="/ctrl/catalogue.php" class="voirPlus">Voir plus</a> <!-- Lien vers la page du catalogue -->
</div>
    <!--------Partie merketing(quality)----------->
    <section class="quality">
        <h2>Miels de Qualités &...</h2>
        <p>
            ..l’alliance subtile de saveurs du monde, de produits exceptionnels sélectionnés avec le plus grand soin,
            qui
            répondent à notre objectif premier: des produits sains et de qualité, accessibles pour tous.Nous nous
            efforçons à vous proposer des miels rares, dont les bienfaits sur la santé sont innombrables,et des parfums
            de luxe aux senteurs exceptionnelles accessibles à tous.
        </p>
    </section>
    <!--------Partie des avis client----------->
   
    <section class="user-advice">
    <h2>AVIS DE NOS CLIENTS</h2>
    <div class="slider2-container">
        <div class="slider2">
            <?php foreach ($listAvis as $avis) { ?>
                <div class="slide2">
                <div class="slide2__name">
                        <h3><?= htmlspecialchars($avis['email']) ?></h3>
                    </div>
                   
                    <p class="slide2__text">
                        <?= htmlspecialchars($avis['content']) ?>
                        
                    </p>
                    <div class="slide2__name">
                        <span>
                            <i class="las la-arrow-right"></i>
                        </span>
                        <h3 class="nomProductAvis"><?= $avis['product_name'] ?></h3>
                    </div>
                </div>
                
            <?php } ?>
        </div>
        <div class="slider2-dots"></div> <!-- Commande en rond pour le client -->
    </div>
</section>


        <!--------Partie pour attirer rassurer les clients----------->
        <section class="trust">
            <div>
                <img src="/asset/img/truck.png" alt="">
                <h3>Livraison en 48h</h3>
                <p>Toutes les commandes sont traitées dans les meilleurs délais, avec livraison mondiale.</p>
            </div>
            <div>
                <img src="/asset/img/phone.png" alt="">
                <h3>SAV irréprochable</h3>
                <p>Chacune de vos recommandations sera traitée rapidement sans exception aucune.</p>
            </div>
            <div>
                <img src="/asset/img/card.png" alt="">
                <h3>Paiement sécurisé</h3>
                <p>Réglez vos achats en toute sécurité et en toute sérénité par carte bancaire ou via PayPal.</p>
            </div>
        </section>
        <section class="section__ban5">
            <div class="section__ban5-left">
                <img src="/asset/img/photoPrincipale.jpg" alt="">
            </div>
            <div class="section__ban5-right">
                <img src="/asset/img/photoPrincipale.jpg" alt="">
            </div>
        </section>
        <section class="section__ban6">
            <div class="section__ban6-text">
                <h4>Avez-vous un problème</h4>
                <p>Nos équipe sont préte à vous répondre le plus rapidement possible!</p>
                <button>Contatez-nous</button>
            </div>
        </section>
        <?php include 'partial/footer.php'; ?>
    <script src="/asset/js/cart.js"></script>
    <script src="/asset/js/sliderAvis.js"></script>
</body>
</html>