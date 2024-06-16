import { getCategorias, getProductos } from '../data.js';

iniciarApp();

const categoriaTitulo = document.querySelector('#categoriaTitulo');
const divProductos = document.querySelector('#productos');
const divPaginación = document.querySelector('#paginacion');
const btnAnterior = document.querySelector('#btnAnterior');
const btnSiguiente = document.querySelector('#btnSiguiente');
const infoPaginacion = document.querySelector('#infoPaginacion');
const infoPaginaInicio = document.querySelector('#infoPaginaInicio');
const infoPaginaFinal = document.querySelector('#infoPaginaFinal');
const infoTotal = document.querySelector('#infoTotal');
const productosPorPagina = 21;
const main = document.querySelector('#main')
let paginaActual = 1;
btnAnterior.disabled = true;
let productosTotal = 0;
let categoria_slug = '';


async function iniciarApp() {
    const categorias = await getCategorias(); //Trae caregorias de la API
    categorias.unshift({slug: '', name: 'Todos', url: 'https://dummyjson.com/products'}); //Agrega la categoria "Todos" al principio del array
    mostrarCategoria(categorias);
    const productos = await getProductos(`?&limit=${productosPorPagina}&select=title,thumbnail,price,rating,id`);
    productosTotal = productos.total;
    actualizarInfo();
    mostrarProductos(productos.products);
}

function mostrarCategoria(categorias) {
    const divCategorias = document.querySelector('#categorias');
    categorias.forEach(element => {
        const p = document.createElement('p');
        p.textContent = element.name;
        p.classList.add('text-lg', 'font-semibold', 'py-2', 'border-b-2', 'border-zinc-200', 'last:border-none', 'cursor-pointer', 'hover:bg-zinc-300');
        p.addEventListener('click', async() => {
            limpiarSeleccionCategorias();
            categoriaTitulo.textContent = element.name;
            paginaActual = 1;
            btnAnterior.disabled = true;
            categoria_slug = element.slug;
            p.classList.add('bg-zinc-300');
            let productos;
            if(element.slug === '') productos = await getProductos(`?&limit=${productosPorPagina}&select=title,thumbnail,price,rating,id`);
            else productos = await getProductos(`/category/${element.slug}?&limit=${productosPorPagina}&select=title,thumbnail,price,rating,id`);
            productosTotal = productos.total;
            if(productos.total > productosPorPagina) {
                infoPaginacion.classList.remove('hidden');
                divPaginación.classList.remove('hidden');
                divPaginación.classList.add('flex');
            } else {
                infoPaginacion.classList.add('hidden');
                divPaginación.classList.remove('flex');
                divPaginación.classList.add('hidden');
            }
            actualizarInfo();
            mostrarProductos(productos.products);
        })
        divCategorias.appendChild(p);
    });
}

function limpiarSeleccionCategorias() {
    const categorias = document.querySelectorAll('#categorias p');
    categorias.forEach(element => {
        element.classList.remove('bg-zinc-300');
    });
}

function mostrarProductos(productos) {
    //console.log(productos);
    divProductos.innerHTML = '';
    productos.forEach(element => {
        const divProducto = document.createElement('div');
        divProducto.classList.add('bg-zinc-100', 'shadow-lg', 'pt-2', 'px-7', 'pb-7', 'space-y-2', 'flex', 'flex-col', 'items-center');
        const divEstrellas = document.createElement('div');
        divEstrellas.classList.add('flex', 'items-center', 'justify-end', 'w-full', 'gap-2');
        const pEstrellas = document.createElement('p');
        pEstrellas.textContent = element.rating;
        pEstrellas.classList.add('text-zinc-600', 'font-bold');
        const imgEstrellas = document.createElement('img');
        imgEstrellas.src = '/img/star.png';
        imgEstrellas.classList.add('w-6', 'h-6');
        divEstrellas.appendChild(pEstrellas);
        divEstrellas.appendChild(imgEstrellas);
        const h3 = document.createElement('h3');
        h3.textContent = element.title;
        h3.classList.add('uppercase', 'font-bold', 'text-center');
        const imgProducto = document.createElement('img');
        imgProducto.src = element.thumbnail;
        imgProducto.classList.add('w-1/2');
        const pPrecio = document.createElement('p');
        pPrecio.textContent = `$${element.price}`;
        pPrecio.classList.add('font-display', 'text-2xl', 'font-semibold', 'text-zinc-900');
        const btnVerMas = document.createElement('button');
        btnVerMas.textContent = 'Ver más';
        btnVerMas.classList.add('px-8', 'bg-zinc-800', 'text-white', 'font-bold', 'font-display', 'uppercase', 'w-2/3', 'text-center', 'hover:bg-zinc-600', 'rounded-md');
        btnVerMas.addEventListener('click', () => {
            window.location.href = `/producto?id=${element.id}`;
        });
        divProducto.appendChild(divEstrellas);
        divProducto.appendChild(h3);
        divProducto.appendChild(imgProducto);
        divProducto.appendChild(pPrecio);
        divProducto.appendChild(btnVerMas);
        divProductos.appendChild(divProducto);
    })
}

btnAnterior.addEventListener('click', async() => {
    if(paginaActual > 1) {
        btnSiguiente.disabled = false;
        paginaActual--;
        paginarProductos();
        main.scrollTop = 0;
        window.scrollTo(0, 0);
    } 
    if(paginaActual === 1) {
        btnAnterior.disabled = true;
    }
});

btnSiguiente.addEventListener('click', async() => {
    let paginasTotales = Math.ceil(productosTotal / productosPorPagina);
    //console.log(paginasTotales, paginaActual)
    if(paginaActual < paginasTotales) {
        btnAnterior.disabled = false;
        paginaActual++;
        paginarProductos();
        main.scrollTop = 0;
        window.scrollTo(0, 0);
    }
    if(paginaActual === paginasTotales) {
        btnSiguiente.disabled = true;
    }
});

async function paginarProductos() {
    actualizarInfo();
    let productos;
    if(categoria_slug === '') productos = await getProductos(`?&limit=${productosPorPagina}&skip=${(paginaActual - 1) * productosPorPagina}&select=title,thumbnail,price,rating,id`);
    else productos = await getProductos(`/category/${categoria_slug}?&limit=${productosPorPagina}&skip=${(paginaActual - 1) * productosPorPagina}&select=title,thumbnail,price,rating,id`);
    mostrarProductos(productos.products);
}

function actualizarInfo(){
    infoPaginaInicio.textContent = (paginaActual - 1) * productosPorPagina + 1;
    let paginasTotales = Math.ceil(productosTotal / productosPorPagina);
    if(paginaActual == paginasTotales) infoPaginaFinal.textContent = productosTotal;
    else infoPaginaFinal.textContent = paginaActual * productosPorPagina;
    infoTotal.textContent = productosTotal;
}