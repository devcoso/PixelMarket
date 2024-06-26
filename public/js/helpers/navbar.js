import { getProductos } from '../data.js';

const menu = document.getElementById('menu');
const hamburguesa = document.getElementById('hamburguesa');

hamburguesa.addEventListener('click', () => {
    menu.classList.toggle('hidden');
    menu.classList.toggle('flex');
});

const search = document.getElementById('search');
const searchMobile = document.getElementById('search-mobile');
const searchMenu = document.getElementById('search-menu');
const searchMenuMobile = document.getElementById('search-menu-mobile');

search.addEventListener('input', (e) => searchProduct(e.target.value));
searchMobile.addEventListener('input', (e) => searchProduct(e.target.value));

async function searchProduct(value) {
    searchMenu.innerHTML = '';
    searchMenuMobile.innerHTML = '';
    if(value === '') return;
    const response = await fetch(`https://dummyjson.com/products/search?q=${value}&select=id,title&limit=3`);
    if(!response.ok) {
        const li = document.createElement('li');
        li.textContent = 'Error al buscar productos, tal vez no hay conenxión a internet';
        searchMenu.appendChild(li);
        searchMenuMobile.appendChild(li.cloneNode(true));
        console.log('Error al buscar productos');
        return;
    }
    const {products} = await response.json();
    products.forEach(product => { 
        const li = document.createElement('button');
        li.classList.add('p-3', 'text-zinc-800','w-full', 'hover:bg-zinc-200', 'uppercase', 'border-b-2', 'border-zinc-200', 'last:border-none', 'cursor-pointer');
        li.textContent = product.title;
        li.addEventListener('click', () => {
            window.location.href = `/producto?id=${product.id}`;
        });
        const liMobile = document.createElement('button');
        liMobile.textContent = product.title;
        liMobile.classList.add('p-3', 'text-zinc-800','w-full', 'hover:bg-zinc-200', 'uppercase', 'border-b-2', 'border-zinc-200', 'last:border-none', 'cursor-pointer');
        liMobile.addEventListener('click', () => {
            window.location.href = `/producto?id=${product.id}`;
        });
        searchMenu.appendChild(li);
        searchMenuMobile.appendChild(liMobile);
    });
}