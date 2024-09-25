document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menu-btn');
    const navbarList = document.querySelector('.mobile-first');
    const closeBtn = document.getElementById('close-btn');
    const cartBtn = document.getElementById('cart-icon');
    const panierProduct = document.querySelector('.cart');
    const closeBtnCart = document.getElementById('close-btn-cart');

    menuBtn.addEventListener('click', function() {
        navbarList.style.left = '0'; 
    });


    closeBtn.addEventListener('click', function() {
        navbarList.style.left = '-110%'; 
    });

    cartBtn.addEventListener('click', function() {
        panierProduct.style.right = '0'; 
    });

    closeBtnCart.addEventListener('click', function() {
        panierProduct.style.right = '-100%'; 
    });
});
