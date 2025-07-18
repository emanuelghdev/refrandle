// Variables globales
const MOBILE_WIDTH = 767;
const TABLET_WIDTH = 1024;

// Listener para mostrar el refrán del dia
document.addEventListener('DOMContentLoaded', function() {
    const icon = document.getElementById("icono-easteregg");
    const target = document.getElementById("footer-container");

    if (!icon || !target) return;

    icon.addEventListener("mouseenter", () => {
        target.style.display = "flex";
    });

    icon.addEventListener("mouseleave", () => {
        target.style.display = "none";
    });
});

// Listener para reescalar la altura de viewport en móviles
window.addEventListener('DOMContentLoaded', () => {
  setVh();
  window.addEventListener('resize', setVh);
});

// Funcion para expandir el nav en responsive
function openNav() {
    const nav = document.getElementById("nav-menu");
    const btn = document.getElementById("dropdown-nav");

    if (!nav || !btn) return;

    // Alternamos la clase 'open' en el nav
    const isOpen = nav.classList.toggle("open");

    // Actualizamos aria-expanded para accesibilidad
    btn.setAttribute("aria-expanded", isOpen ? "true" : "false");
}

// Funcion para controlar que la altura en móviles sea la del viewport real
function setVh() {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}