const usuariosP = document.querySelector('#usuarios-p');
const stockP = document.querySelector('#stock-p');
const productosP = document.querySelector('#productos-p');
const ingresosP = document.querySelector('#ingresos-p');
const comprasP = document.querySelector('#compras-p');
const articulosP = document.querySelector('#articulos-p');

consultar();

async function consultar() {
    const response = await fetch('/admin/api/dashboard');
    const data = await response.json();
    if(data.ok) {
        actualizarP(data);
        graficas(data.top_10_productos, data.top_5_categorias);
    }
    else console.log(data.mensaje);
}

function actualizarP(datos) {
    usuariosP.textContent = formatearNumero(datos.total_usuarios);
    stockP.textContent = formatearNumero(datos.total_stock);
    productosP.textContent = formatearNumero(datos.total_productos);
    ingresosP.textContent = formatearNumero(datos.ingresos);
    comprasP.textContent = datos.total_compras;
    articulosP.textContent = datos.articulos_vendidos;
}

function formatearNumero(valor, locale = 'es-MX') {
    return new Intl.NumberFormat(locale, {
        minimumFractionDigits: 0,
        maximumFractionDigits: 2
    }).format(valor);
}

function graficas(productos, categorias) {
    const top_10_productos = document.getElementById('top_10_productos');
    const top_5_categorias = document.getElementById('top_5_categorias');
    console.log(productos, categorias);
    new Chart(top_10_productos, {
        type: 'bar',
        data: {
        labels: productos.map(p => p.titulo),
        datasets: [{
            label: 'Ventas',
            data: productos.map(p => p.ventas),
            borderWidth: 1,
            backgroundColor: '#27272a',
            hoverBackgroundColor: '#52525b'
            
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    new Chart(top_5_categorias, {
        type: 'bar',
        data: {
        labels: categorias.map(c => c.nombre),
        datasets: [{
            label: 'Ventas',
            data: categorias.map(c => c.ventas),
            borderWidth: 1,
            backgroundColor: '#27272a',
            hoverBackgroundColor: '#52525b'
            
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
}