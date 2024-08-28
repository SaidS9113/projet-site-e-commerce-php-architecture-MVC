document.addEventListener('DOMContentLoaded', function() {
    const poidsSelect = document.getElementById('poids');
    const priceDisplay = document.getElementById('price-display');
    const quantityDisplay = document.getElementById('quantity-display');

    // Function to update URL
    function updateUrl(poids, price) {
        const url = new URL(window.location.href);
        url.searchParams.set('poids', poids);
        url.searchParams.set('price', price);
        window.history.replaceState({}, '', url);
    }

    poidsSelect.addEventListener('change', function() {
        const selectedOption = poidsSelect.options[poidsSelect.selectedIndex];
        const poids = selectedOption.value;
        const price = selectedOption.getAttribute('data-price');
        const quantity = selectedOption.getAttribute('data-quantity');

        // Update the price and quantity display
        priceDisplay.textContent = 'Prix: ' + parseFloat(price).toFixed(2) + '€';
        quantityDisplay.textContent = 'Quantité disponible: ' + quantity;

        // Update the URL
        updateUrl(poids, price);
    });

    // Set initial URL based on the default selection
    const initialOption = poidsSelect.options[poidsSelect.selectedIndex];
    if (initialOption) {
        const poids = initialOption.value;
        const price = initialOption.getAttribute('data-price');
        updateUrl(poids, price);
    }
});