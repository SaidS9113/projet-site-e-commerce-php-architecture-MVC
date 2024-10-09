<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../asset/css/style.css">
    <title>MielQualityS | Inscription</title>

</head>
<body>
    <!---------Barre de promotion----------->
    <div class="promo">
        <p>Livraison gratuite à partir de 50€</p>
    </div>
    
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
    
    <h1 class="bvn">Inscription</h1>
      <!-- Messages d'erreur (invisible par défaut) -->
      <div id="errorBanner" class="error-banner" style="display: none;">
            <ul id="errorList"></ul>
        </div>

        <!-- Formulaire -->
        <form id="inscriptionForm" action="/ctrl/inscription/add.php" method="post">
           <!-- nom -->
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="" required>
                <p class="error2" id="nomError"></p>
            </div>
            
            <!-- prenom -->
            <div>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="" required>
                
            </div>
            
            <!-- email -->
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="" required>
          
            </div>

            <!-- password -->
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
  
            </div>

            <!-- confirm password -->
            <div>
                <label for="confirm_password">Confirmez le mot de passe</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
             
            </div>

            <!-- submit -->
            <div class="submit">
                <button type="submit">Valider</button>
            </div>
        </form>
 

   
<script src="/asset/js/errorInscription.js"></script>
    <script src="/asset/js/cart.js"></script>
</body>
</html>
