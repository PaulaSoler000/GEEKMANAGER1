//nav
const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-links li");

hamburger.addEventListener('click', () => {
    // Animacion de los links
    navLinks.classList.toggle("open");
    links.forEach(link => {
        link.classList.toggle("fade");
    });

    // Animacion de la hamburguesa
    hamburger.classList.toggle("toggle");
});


//modal editar
const openModal2 = document.querySelector('.hero__cta2');
const modal2 = document.querySelector('.modal2');
const closeModal2 = document.querySelector('.modal__close2');

openModal2.addEventListener('click', (e) => {
    e.preventDefault();
    modal2.classList.add('modal--show2');
});

closeModal2.addEventListener('click', (e) => {
    e.preventDefault();
    modal2.classList.remove('modal--show2');
});

//modal eliminar
const openModal3 = document.querySelector('.hero__cta3');
const modal3 = document.querySelector('.modal3');
const closeModal3 = document.querySelector('.modal__close3');

openModal3.addEventListener('click', (e) => {
    e.preventDefault();
    modal3.classList.add('modal--show3');
});

closeModal3.addEventListener('click', (e) => {
    e.preventDefault();
    modal3.classList.remove('modal--show3');
});

//modal añadir
const openModal = document.querySelector('.hero__cta');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal__close');

openModal.addEventListener('click', (e) => {
    e.preventDefault();
    modal.classList.add('modal--show');
});

closeModal.addEventListener('click', (e) => {
    e.preventDefault();
    modal.classList.remove('modal--show');
});

