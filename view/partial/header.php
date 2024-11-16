<?php
// Vérifier si l'utilisateur s'est authentifié
$isLoggedIn = isset($_SESSION['user']); 
$bienvenue = "Bienvenue,";
?>
    <!---------Barre de promotion----------->
<div class="promo">
    <p>Livraison gratuite à partir de 50€</p>
</div>
<!---------En-tête de page----------->
<header class="header" id="header">
    <!-- Section de connexion si l'utilisateur est connecté -->
    <div class="header-version-m-t-p"> <!-- Div header pour toutes les versions -->
        <i class="bx bx-menu-alt-left" id="menu-btn" style="font-size: 2.5rem;"></i>

        <!-- Menu défilant pour mobile et tablette -->
        <nav class="mobile-first">
        <span id="close-btn" style="float:right; cursor:pointer;">&times;</span>
            <div class="flex-column">
            <!-- Logo du site -->
            <a class="logoNavbar" href="/ctrl/accueil.php"><img src="/asset/img/logoHorizontale.png" alt=""></a>
            <!-- Liste des pages du site -->
            <ul class="listSite">
                <!-- Affichage de "Accueil" et "Produits" pour tous les utilisateurs sauf ceux ayant le rôle 10 -->
        <?php if (!($isLoggedIn && $_SESSION['user']['idRole'] == '10')) : ?>
            <li><a href="/ctrl/accueil.php">Accueil</a></li>
            <li><a href="/ctrl/catalogue.php">Nos Miels</a></li>
        <?php endif; ?>
        <!-- Options supplémentaires visibles uniquement pour l'utilisateur avec le rôle 10 -->
        <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?>
            <li><a href="/ctrl/product/list.php">Produits</a></li>
            <li><a href="/ctrl/commande.php">Commandes</a></li>
            <li><a href="/ctrl/inscription/list.php">Utilisateurs</a></li>
            <li><a href="/ctrl/profil-info/update-display.php">Modifier le profil</a></li>
        <?php endif; ?>
                <!-- Lien Connexion visible si l'utilisateur n'est pas connecté -->
                <?php if (!$isLoggedIn) : ?>
                    <li><a href="/ctrl/login/display.php">Connexion</a></li>
                    <li><a href="/ctrl/inscription/add-display.php">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
            <!-- Affichage de la boîte de connexion pour mobile si l'utilisateur est connecté -->
            <?php if ($isLoggedIn) : ?>
                <div class="boiteLogin-mobile-first">
    <span class="infoUser"><?=$bienvenue?> <?= $_SESSION['user']['prenom'] ?> <?= strtoupper($_SESSION['user']['nom']) ?></span>

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
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/ctrl/cart/cart_counter2.php'; ?>
        <!-- Icône du panier -->
       <a href="/ctrl/cart/cart.php">
    <i class='bx bx-shopping-bag' id="cart-icon-first">
        <sup id="cart-count"><?php echo $totalQuantity2; ?></sup>
    </i>
</a>
    </div>

    <?php if ($isLoggedIn) : ?>
    <div class="boiteLogin">
        <p class="bienvenueUser"><?=$bienvenue?></p>
        <span class="infoUser"><?= $_SESSION['user']['prenom'] ?> <?= strtoupper($_SESSION['user']['nom']) ?></span>
    </div>
<?php endif; ?>

    <!--------Menu pour la version PC----------->
    <nav class="version-desktop">
    <ul>
        <!-- Affichage de "Accueil" et "Produits" pour tous les utilisateurs sauf ceux ayant le rôle 10 -->
        <?php if (!($isLoggedIn && $_SESSION['user']['idRole'] == '10')) : ?>
            <li><a href="/ctrl/accueil.php">Accueil</a></li>
            <li><a href="/ctrl/catalogue.php">Nos Miels</a></li>
        <?php endif; ?>

        <!-- Options supplémentaires visibles uniquement pour l'utilisateur avec le rôle 10 -->
        <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?>
            <li><a href="/ctrl/product/list.php">Produits</a></li>
            <li><a href="/ctrl/commande.php">Commandes</a></li>
            <li><a href="/ctrl/inscription/list.php">Utilisateurs</a></li>
        <?php endif; ?>
    </ul>

    <div class="tablette-first_recherche_cart">
    <!-- Icône de profil selon l'état de connexion -->
    <?php if ($isLoggedIn) : ?>
        <a href="#" id="user-icon">
            <i class='bx bx-user'></i>
        </a>
    <?php else : ?>
        <a href="/ctrl/login/display.php" id="user-icon">
            <i class='bx bx-user'></i>
        </a>
    <?php endif; ?>
    
    <!-- Fenêtre contextuelle qui apparaîtra au survol de l'icône utilisateur -->
    <div id="user-popup" class="popup" style="display: none;">
        <?php if ($isLoggedIn) : ?>
            <a class="voirProfil" href="/ctrl/profil-info/update-display.php">Voir le profil</a>
            <div class="boiteDeconnexion">
            <a href="/ctrl/login/logout.php" class="btnDeconnexion"><i class='bx bx-exit'></i>
            <span class="nameDeconnexion">Déconnexion</span>
            </a>
        </div>
        <?php else : ?>
            <a class="connecter" href="/ctrl/login/display.php">Se connecter</a>
            <a class="inscrire" href="/ctrl/inscription/add-display.php">S'inscrire</a>
        <?php endif; ?>
    </div>


<!-- Script pour gérer l'affichage du popup -->
<!-- Script pour gérer l'affichage du popup -->
<script>
// Sélection des éléments HTML
const userIcon = document.getElementById('user-icon');
const userPopup = document.getElementById('user-popup');

// Fonction pour afficher la popup
function showPopup() {
    userPopup.style.display = 'block';
}

// Fonction pour masquer la popup
function hidePopup() {
    userPopup.style.display = 'none';
}

// Afficher la popup quand la souris est sur l'icône ou sur la popup
userIcon.addEventListener('mouseover', showPopup);
userPopup.addEventListener('mouseover', showPopup);

// Masquer la popup uniquement lorsque la souris quitte à la fois l'icône et la popup
userIcon.addEventListener('mouseout', function(event) {
    setTimeout(function() {
        if (!userPopup.matches(':hover') && !userIcon.matches(':hover')) {
            hidePopup();
        }
    }, 200); // délai avant de cacher la popup
});

userPopup.addEventListener('mouseout', function(event) {
    setTimeout(function() {
        if (!userPopup.matches(':hover') && !userIcon.matches(':hover')) {
            hidePopup();
        }
    }, 200); // délai avant de cacher la popup
});
</script>


            <?php include $_SERVER['DOCUMENT_ROOT'] . '/ctrl/cart/cart_counter.php'; ?>
         <!-- Icône du panier -->
    <a href="/ctrl/cart/cart.php">
    <i class='bx bx-shopping-bag' id="cart-icon">
        <sup id="cart-count"><?php echo $totalQuantity; ?></sup>
    </i>
</a>
        </div>
    </nav>
</header>
