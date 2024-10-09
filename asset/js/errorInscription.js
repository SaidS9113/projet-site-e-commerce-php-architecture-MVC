document.getElementById('inscriptionForm').addEventListener('submit', function(event) {
        // Empêcher l'envoi par défaut pour gérer la validation
        event.preventDefault();
        
        // Réinitialiser les messages d'erreur
        let errors = [];
        const errorBanner = document.getElementById('errorBanner');
        const errorList = document.getElementById('errorList');
        errorList.innerHTML = ""; // Vider la liste d'erreurs

        // Récupération des valeurs des champs
        const nom = document.getElementById('nom').value;
        const prenom = document.getElementById('prenom').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        // Validation du champ nom
        if (nom === "") {
            errors.push("Veuillez entrer votre nom.");
        }

        // Validation du champ prénom
        if (prenom === "") {
            errors.push("Veuillez entrer votre prénom.");
        }

        // Validation de l'email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errors.push("Veuillez entrer un email valide.");
        }

        // Validation du mot de passe
        if (password.length < 5) {
            errors.push("Le mot de passe doit comporter au moins 6 caractères.");
        }

        // Validation de la confirmation du mot de passe
        if (password !== confirmPassword) {
            errors.push("Les mots de passe ne correspondent pas.");
        }

        // Si des erreurs existent, les afficher
        if (errors.length > 0) {
            errorBanner.style.display = "block"; // Afficher la bande d'erreurs
            errorBanner.style.backgroundColor = "#f8d7da"; // Couleur de fond pour les erreurs
            errorBanner.style.color = "#721c24"; // Couleur du texte pour les erreurs
            errors.forEach(function(error) {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li); // Ajouter chaque erreur à la liste
            });
        } else {
            // Si aucune erreur, afficher le message de succès
            errorBanner.style.display = "block"; // Afficher la bande
            errorBanner.style.backgroundColor = "#d4edda"; // Couleur de fond pour le succès (vert clair)
            errorBanner.style.color = "#155724"; // Couleur du texte pour le succès (vert foncé)
            errorList.innerHTML = "<li>Inscription réussie !</li>"; // Message de succès

            // Optionnel : Soumettre le formulaire après un délai pour laisser le message de succès s'afficher
            setTimeout(() => {
                this.submit(); // Soumettre le formulaire après un délai
            }, 2000); // 2 secondes de délai
        }
    });

