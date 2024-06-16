const menu = document.getElementById('menu');
const hamburguesa = document.getElementById('hamburguesa');

hamburguesa.addEventListener('click', () => {
    menu.classList.toggle('hidden');
    menu.classList.toggle('flex');
});