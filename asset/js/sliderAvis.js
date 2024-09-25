/* Témoignages des clients dynamique*/
const slider2 = document.querySelector('.slider2');
const slides2 = document.querySelectorAll('.slide2');
const slide2Width = slides2[0].offsetWidth;

let currentIndex = 0;

function nextSlide2() {
    currentIndex++;
    if (currentIndex >= slides2.length) {
        currentIndex = 0;
    }
    updateSlider2();
}

function updateSlider2() {
    slider2.style.transform = `translateX(-${currentIndex * slide2Width}px)`;
    const dots = document.querySelectorAll('.dot');

    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex);
    });
}

const slider2Dots = document.querySelector('.slider2-dots');
for (let i = 0; i < slides2.length; i++){
    const dot = document.createElement('div');
    dot.classList.add('dot');
    dot.addEventListener('click', () => {
        currentIndex = i;
        updateSlider2();
    });
    slider2Dots.appendChild(dot);
}
setInterval(nextSlide2, 1800);

