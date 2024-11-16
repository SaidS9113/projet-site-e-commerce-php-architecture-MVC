const slider2 = document.querySelector('.slider2');
let slides2 = Array.from(document.querySelectorAll('.slide2'));
const slide2Width = slides2[0].offsetWidth;
const totalSlides = slides2.length;

// Ajuste la largeur totale du conteneur pour inclure les clones
slider2.style.width = `${slide2Width * Math.max(totalSlides, 1)}px`; // Largeur de 4 diapositives

// Duplique les diapositives pour créer l'effet de boucle seulement si totalSlides >= 4
if (totalSlides >= 4) {
    slides2.forEach(slide => {
        const clone = slide.cloneNode(true);
        slider2.appendChild(clone);
    });
}

// Ajout d'une nouvelle variable pour le nombre total de diapositives, incluant les clones
const adjustedTotalSlides = totalSlides >= 2 ? totalSlides * 2 : 4;

// Positionne le slider en fonction du nombre total de diapositives ajustées
let currentIndex = 0;
let allowTransition = true;

// Créer les dots de navigation
const slider2Dots = document.querySelector('.slider2-dots');
const dots = [];

// Ajoute un dot pour chaque diapositive originale
for (let i = 0; i < totalSlides; i++) {
    const dot = document.createElement('div');
    dot.classList.add('dot');
    dot.addEventListener('click', () => {
        currentIndex = i; // Va à la diapositive correspondante
        updateSlider2();
    });
    slider2Dots.appendChild(dot);
    dots.push(dot);
}

// Active le premier dot par défaut
dots[0].classList.add('active');

// Fonction pour déplacer les diapositives et mettre à jour les dots
function updateSlider2() {
    slider2.style.transition = 'transform 0.5s ease-in-out';
    slider2.style.transform = `translateX(-${(currentIndex % totalSlides) * slide2Width}px)`;

    // Mise à jour des dots
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex % totalSlides);
    });
}

function nextSlide2() {
    if (!allowTransition) return; // Empêche les multiples transitions
    allowTransition = false;

    currentIndex++;
    updateSlider2();

    // Réactive la transition après un délai correspondant à la durée de la transition
    setTimeout(() => {
        allowTransition = true;
    }, 500); // Délai correspondant à la durée de la transition
}

function prevSlide2() {
    if (!allowTransition) return;
    allowTransition = false;

    currentIndex--;
    updateSlider2();

    // Réactive la transition après un délai correspondant à la durée de la transition
    setTimeout(() => {
        allowTransition = true;
    }, 500); // Délai correspondant à la durée de la transition
}

// Mise à jour automatique si le nombre de diapositives est supérieur ou égal à 4
if (totalSlides >= 4) {
    setInterval(nextSlide2, 1800);
}
