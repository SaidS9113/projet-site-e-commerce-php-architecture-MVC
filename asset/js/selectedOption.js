document.addEventListener('DOMContentLoaded', function() {
    const poidsSelect = document.getElementById('poids');
    const priceDisplay = document.getElementById('price-display');
    const quantityDisplay = document.getElementById('quantity-display');

    // Mettre à jour le prix et la quantité lors du chargement initial
    updateDisplay();

    // Mettre à jour le prix et la quantité lorsqu'un nouvel élément est sélectionné
    poidsSelect.addEventListener('change', function() {
        updateDisplay();
    });

    function updateDisplay() {
        const selectedOption = poidsSelect.options[poidsSelect.selectedIndex];
        const selectedPrice = selectedOption.getAttribute('data-price');
        const selectedQuantity = selectedOption.getAttribute('data-quantity');
        
        priceDisplay.textContent = 'Prix: ' + parseFloat(selectedPrice).toFixed(2) + ' €';
        quantityDisplay.textContent = 'Quantité disponible: ' + selectedQuantity;
    }
});