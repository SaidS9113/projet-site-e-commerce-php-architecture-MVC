function updatePrice() {
    const selectElement = document.getElementById('option');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const price = selectedOption.value;
    document.getElementById('price-display').innerText = `Prix : ${price}€`;
}

// Initialiser l'affichage du prix au chargement de la page
document.addEventListener('DOMContentLoaded', updatePrice);