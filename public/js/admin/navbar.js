const hamburguesaNav = document.getElementById('hamburguesa');
const enlacesNav = document.querySelectorAll('.nav-movil');

hamburguesaNav.addEventListener('click', () => {
    enlacesNav.forEach(element => {
        element.classList.toggle('hidden');
        element.classList.toggle('block');
    });
});