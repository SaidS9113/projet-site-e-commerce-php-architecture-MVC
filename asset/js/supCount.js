// Exemple d'AJAX pour mettre à jour le panier en temps réel
function updateCartCount() {
    fetch('/ctrl/cart/getCartQuantity.php') // Créez un fichier PHP qui renvoie la quantité totale
        .then(response => response.json())
        .then(data => {
            document.getElementById('cart-count-first').textContent = data.totalQuantity;
        })
        .catch(error => console.error('Erreur lors de la mise à jour du panier:', error));
}

// Appeler cette fonction après chaque ajout/suppression au panier
