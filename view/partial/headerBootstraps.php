<?php
//Verifier si l'user s'est authentifié
$isLoggedIn = isset($_SESSION['user']); ?>

<body class="bodyAccueil">

    <div class="barrePubBootstraps">
        <p>Découvrez nos voitures de sport</p>
    </div>
    <header>
        <?php if ($isLoggedIn) : ?>

            <div class="nameProfilUserBootstraps">
            
                 
                    <span class="nameUser"><?= ($_SESSION['user']['email']) ?></span>
            </div>
           
            <a href="/ctrl/login/logout.php" class="btnLog2">Deconnexion</a>
            
        <?php else : ?>
          
           
            
        <?php endif; ?>
        <nav>
            <ul>
                <div class="flexNav">
                <li><a href="/ctrl/accueil.php">Accueil</a></li>
                <li><a href="/ctrl/catalogue.php">Produits</a></li>
                </div>
                <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?> <!-- cache le lien Gestion Aministrateur si l'utilisateur n'a pas le role admin -->
                    <li><a href="/ctrl/product/add-display.php">AjoutProduits</a></li>
                <?php endif; ?>
                <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?> <!-- cache le lien Gestion Aministrateur si l'utilisateur n'a pas le role admin -->
                    <li><a href="/ctrl/product/list.php">ListeProduits</a></li>
                <?php endif; ?>
           
                <li><a href="/ctrl/commande.php">ListeCommandes</a></li>
                
                    <li><a href="/ctrl/inscription/list.php">ListeUtilisateurs</a></li>
              
            </ul>
            <div class="boiteIcons">
        <?php if ($isLoggedIn) : ?>
            <!-- Utilisateur connecté -->
            <a href="/ctrl/profil-info/update-display.php"><i class='bx bx-user'></i></a> <!-- Remplacez /ctrl/other-page.php par la page souhaitée -->
        <?php else : ?>
            <!-- Utilisateur non connecté -->
            <a href="/ctrl/login/display.php"><i class='bx bx-user'></i></a>
        <?php endif; ?>
        <a href="/ctrl/cart/cart.php"><i class='bx bx-cart'></i></a>
    </div>
        </nav>

    </header>

</body>

</html>