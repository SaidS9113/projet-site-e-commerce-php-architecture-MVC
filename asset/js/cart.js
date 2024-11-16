document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menu-btn');
    const navbarList = document.querySelector('.mobile-first');
    const closeBtn = document.getElementById('close-btn');
    // Vérifiez que les éléments existent avant d'ajouter les écouteurs d'événements
    if (menuBtn && navbarList) {
        menuBtn.addEventListener('click', function() {
            navbarList.style.left = '0'; 
        });
    }

    if (closeBtn && navbarList) {
        closeBtn.addEventListener('click', function() {
            navbarList.style.left = '-110%'; 
        });
    }
});
