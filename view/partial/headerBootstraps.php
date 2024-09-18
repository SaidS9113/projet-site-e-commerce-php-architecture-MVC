<?php
//Verifier si l'user s'est authentifié
$isLoggedIn = isset($_SESSION['user']); ?>

<body class="bodyAccueil">

    <div class="barrePubBootstraps">
    <p>Livraison gratuite à partir de 50€</p>
    </div>
    <!---------En-tête de page----------->
<header class="header" id="header">

<!-- Section de connexion si l'utilisateur est connecté -->
<?php if ($isLoggedIn) : ?>
<div class="boiteLogin">
    <span class="infoUser"><?= htmlspecialchars($_SESSION['user']['email']) ?></span>

    <div class="boiteDeconnexion">
        <a href="/ctrl/login/logout.php" class="btnDeconnexion"><i class='bx bx-exit'></i></a>
        <span class="nameDeconnexion">Déconnexion</span>
    </div>
</div>
<?php endif; ?>

<div class="header-version-m-t-p"> <!-- Div header pour toutes les versions -->
    <i class="bx bx-menu-alt-left" id="menu-btn" style="font-size: 2.5rem;"></i>

    <!-- Menu défilant pour mobile et tablette -->
    <nav class="mobile-first">
        <span id="close-btn" style="float:right; cursor:pointer;">&times;</span>
        <div class="flex-column">
        <!-- Logo du site -->
        <a class="logoNavbar" href="/ctrl/accueil.php"><img src="/asset/img/logoSiteEcommerce.png" alt=""></a>

        <!-- Liste des pages du site -->
        <ul class="listSite">
            <li><a href="/ctrl/accueil.php">Accueil</a></li>
            <li><a href="/ctrl/catalogue.php">Produits</a></li>

            <!-- Lien vers la gestion des produits si l'utilisateur est administrateur -->
            <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?>
                <li><a href="/ctrl/product/add-display.php">Ajouter Produits</a></li>
                <li><a href="/ctrl/product/list.php">Liste Produits</a></li>
                <li><a href="/ctrl/commande.php">Liste Commandes</a></li>
                <li><a href="/ctrl/inscription/list.php">Liste Utilisateurs</a></li>
            <?php endif; ?>

            <!-- Lien Connexion visible si l'utilisateur n'est pas connecté -->
            <?php if (!$isLoggedIn) : ?>
                <li><a href="/ctrl/login/display.php">Connexion</a></li>
            <?php endif; ?>
        </ul>

        <!-- Affichage de la boîte de connexion pour mobile si l'utilisateur est connecté -->
        <?php if ($isLoggedIn) : ?>
        <div class="boiteLogin-mobile-first">
            <span class="infoUser"><?= htmlspecialchars($_SESSION['user']['email']) ?></span>

            <div class="boiteDeconnexion">
                <a href="/ctrl/login/logout.php" class="btnDeconnexion"><i class='bx bx-exit'></i></a>
                <span class="nameDeconnexion">Déconnexion</span>
            </div>
        </div>
        <?php endif; ?>
 <!-- Liste des réseaux sociaux -->
 <div class="boiteReseauxScl">
        <ul class="listReseauxScl">
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#"><i class="fab fa-snapchat"></i></a></li>
            <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
        </ul>
       </div>
       </div>
    </nav>

    <!---------Logo toujours au centre----------->
    <div class="container-logo">
        <h1><a href="/ctrl/accueil.php"><img src="/asset/img/logoHorizontale.png" alt=""></a></h1>
    </div>

    <!-- Icône du panier -->
    <a href="/ctrl/cart/cart.php"><i class='bx bx-shopping-bag' id="cart-icon-first"><sup id="cart-count-first">0</sup></i></a>
</div>

<!--------Menu pour la version PC----------->
<nav class="version-desktop">
    <ul>
        <li><a href="/ctrl/accueil.php">Accueil</a></li>
        <li><a href="/ctrl/catalogue.php">Produits</a></li>

        <!-- Lien vers la gestion des produits si l'utilisateur est administrateur -->
        <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?>
            <li><a href="/ctrl/product/add-display.php">Ajout Produits</a></li>
            <li><a href="/ctrl/product/list.php">Liste Produits</a></li>
            <li><a href="/ctrl/commande.php">Liste Commandes</a></li>
            <li><a href="/ctrl/inscription/list.php">Liste Utilisateurs</a></li>
        <?php endif; ?>
    </ul>

    <div class="tablette-first_recherche_cart">
        <!-- Icône de profil selon l'état de connexion -->
        <?php if ($isLoggedIn) : ?>
            <a href="/ctrl/profil-info/update-display.php"><i class='bx bx-user'></i></a>
        <?php else : ?>
            <a href="/ctrl/login/display.php"><i class='bx bx-user'></i></a>
        <?php endif; ?>

        <!-- Icône du panier -->
        <a href="/ctrl/cart/cart.php"><i class='bx bx-shopping-bag' id="cart-icon"><sup id="cart-count">0</sup></i></a>
    </div>
</nav>
</header>
