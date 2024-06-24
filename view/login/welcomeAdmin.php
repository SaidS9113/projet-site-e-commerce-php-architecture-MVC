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
    <link rel="stylesheet" href="/asset/css/style.css">
    <title>Site e-commerce | Admin MielQualitys</title>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php'; ?>
    <h2 class="bvn">Bienvenue Admin</h2>

    <div class="error-message">
        <?php
        session_start(); // ca initialise une session et la stock ou la reprend si elle existe déja dans les cookies. c'est grace à cette fonction qu'on peut utiliser la variable session
        // message du formulaire de login ca affiche le contenue de "error"
        if (isset($_SESSION['error'])) { // isset verifie si ($_SESSION['error']) est pas null
            echo '<p class= "error-message">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']); // unset ca retire ($_SESSION['error']) de la session pour supprimer le message d'érreur de la session
        }

        // message du formulaire d'inscription ca affiche le contenu de "sucess" ou "error"
        if (isset($_SESSION['success'])) { // ca verifie s'il y a le message de succès dans la session
            echo '<p class="messageInscription">' . $_SESSION['success'] . '</p>'; // afiche
            unset($_SESSION['success']); // supprime le message de succès de la session
        } elseif (isset($_SESSION['error'])) { // ca vérifie s'il y a un message d'erreur dans la session
            echo '<p class="error-message">' . $_SESSION['error'] . '</p>'; // affiche
            unset($_SESSION['error']); // supprime le message d'erreur de la session
        }
        ?>
    </div>
  
</body>
</html>