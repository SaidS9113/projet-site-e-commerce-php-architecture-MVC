<?php
//Verifier si l'user s'est authentifié
$isLoggedIn = isset($_SESSION['user']); ?>

<body class="bodyAccueil">

    <div class="barrePub">
        <p>Découvrez nos voitures de sport</p>
    </div>
    <header>
        <?php if ($isLoggedIn) : ?>

            <div class="nameProfilUser">
            
                    <img src="<?= '/upload/' . $_SESSION['user']['photo_filename'] ?>" width="50" />
                    <span class="nameUser"><?= ($_SESSION['user']['email']) ?></span>
            </div>
           
            <a href="/ctrl/login/logout.php" class="btnLog2">Deconnexion</a>
            
        <?php else : ?>
          
           
            
        <?php endif; ?>
        <nav>
            <ul>
                <div class="flexNav">
                <li><a href="/ctrl/accueil.php">Accueil</a></li>
                <li><a href="/ctrl/article.php">Véhicules</a></li>
                </div>
                <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?> <!-- cache le lien Gestion Aministrateur si l'utilisateur n'a pas le role admin -->
                    <li><a href="/ctrl/add-article/add-display.php">AjoutVehicule</a></li>
                <?php endif; ?>
                <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?> <!-- cache le lien Gestion Aministrateur si l'utilisateur n'a pas le role admin -->
                    <li><a href="/ctrl/add-article/list.php">ListVehicule</a></li>
                <?php endif; ?>
                <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?> <!-- cache le lien Gestion Aministrateur si l'utilisateur n'a pas le role admin -->
                    <li><a href="/ctrl/profil/profile-list.php">ProfilImageList</a></li>
                <?php endif; ?>
                <?php if ($isLoggedIn && $_SESSION['user']['idRole'] == '10') : ?> <!-- cache le lien Gestion Aministrateur si l'utilisateur n'a pas le role admin -->
                    <li><a href="/ctrl/profil/profile-add-display.php">AjoutImageProfil</a></li>
                <?php endif; ?>
            </ul>
            <div class="boiteIcons">
                <a href="/ctrl/login/display.php"><i class='bx bx-user'></i></a>
                <a href=""><i class='bx bx-cart'></i></a>
            </div>
        </nav>

    </header>

</body>

</html>