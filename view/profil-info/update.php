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
    <title>MielQualityS | Modifier le profil</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/header.php' ?>
  
<h1 class="modifInfoProfil">Modification des informations</h1>
<!-- Section pour afficher les messages -->
<div id="message" style="display:none; padding: 10px; margin-bottom: 15px; border: 1px solid; border-radius: 5px; text-align: center;"></div>

<form class="formUpdate" id="updateForm">
    <!-- ID de l'utilisateur -->
    <input type="hidden" name="id" value="<?= $userInfo['id'] ?? '' ?>">

    <!-- Nom -->
    <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?= $userInfo['nom'] ?? '' ?>" required>
    </div>

    <!-- Prénom -->
    <div>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" value="<?= $userInfo['prenom'] ?? '' ?>" required>
    </div>

    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $userInfo['email'] ?? '' ?>" required>
    </div>

    <!-- Adresse -->
    <div>
        <label for="adresse">Adresse</label>
        <input type="adresse" name="adresse" id="adresse" value="<?= $userInfo['adresse'] ?? '' ?>" required>
    </div>
    
    <!-- Code postal -->
    <div>
        <label for="code_postal">Code postal</label>
        <input type="code_postal" name="code_postal" id="code_postal" value="<?= $userInfo['code_postal'] ?? '' ?>" required>
    </div>
    <!-- Mot de passe -->
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
    </div>

    <!-- Confirmation du mot de passe -->
    <div>
        <label for="password_confirm">Confirmer le mot de passe</label>
        <input type="password" name="password_confirm" id="password_confirm" required>
    </div>

    <!-- Bouton de soumission -->
    <div class="submit">
        <button type="submit">Modifier</button>
    </div>
</form>

<script>
    document.getElementById('updateForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche la soumission par défaut du formulaire

        // Récupérer les valeurs du formulaire
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirm').value;

        // Vérification des mots de passe
        if (password !== passwordConfirm) {
            showMessage("Les mots de passe ne correspondent pas. Aucune modification effectuée.", "error");
            return;
        }

        // Créer un objet FormData pour envoyer les données du formulaire
        const formData = new FormData(this);

        // Envoyer les données avec AJAX
        fetch('/ctrl/profil-info/update.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // On attend une réponse JSON
        .then(data => {
            if (data.success) {
                showMessage("Mise à jour réussie ! Vous serez redirigé vers la page de connexion.", "success");
                // Rediriger après 2 secondes
                setTimeout(() => {
                    window.location.href = '/ctrl/accueil.php';
                }, 2000);
            } else {
                showMessage(data.message, "error"); // Afficher le message d'erreur
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showMessage("Une erreur est survenue. Veuillez réessayer.", "error");
        });
    });

    function showMessage(message, type) {
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = message;
        messageDiv.style.display = 'block';
        messageDiv.style.color = type === 'error' ? 'red' : 'green';
        messageDiv.style.borderColor = type === 'error' ? 'red' : 'green';
    }
</script>

<script src="/asset/js/cart.js"></script>
</body>
</html>
