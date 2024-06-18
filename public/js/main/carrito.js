const botonesMas = document.querySelectorAll('.mas');
const botonesMenos = document.querySelectorAll('.menos');
const spanTotalGlobal = document.querySelector('#total');

botonesMas.forEach(boton => boton.addEventListener('click', () => actualizarCantidad(boton.dataset.id, true)))
botonesMenos.forEach(boton => boton.addEventListener('click', () => actualizarCantidad(boton.dataset.id, false)))

async function actualizarCantidad(id, sumar) {
    spanCantidad = document.querySelector(`#cantidad-${id}`);
    spanPrecio = document.querySelector(`#precio-${id}`);
    spanTotal = document.querySelector(`#total-${id}`);
    cantidad = convertirCadenaADinero(spanCantidad.textContent);
    precio = convertirCadenaADinero(spanPrecio.textContent);
    if (sumar && (cantidad < 10)) {
        cantidad++;
    } else if(!sumar && cantidad > 1){
        cantidad--;
    } else { return; }
    const datos = new FormData();
    datos.append('id', id);
    datos.append('cantidad', cantidad);
    const respuesta = await fetch('/carrito/editar', {
        method: 'POST',
        body: datos
    });
    const respuestaJSON = await respuesta.json();
    if(!respuestaJSON.ok){
        console.error(respuestaJSON.error);
        return;
    }
    spanCantidad.textContent = cantidad;
    spanTotal.textContent = formatearDinero(cantidad * precio);
    calcularTotal();
}

function formatearDinero(valor, locale = 'es-MX') {
    return new Intl.NumberFormat(locale, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(valor);
}

function convertirCadenaADinero(cadena) {
    // Elimina los caracteres no numéricos excepto el punto decimal
    let numero = cadena.replace(/[^0-9.-]+/g, '');
    // Convierte la cadena resultante a un número flotante
    return parseFloat(numero);
}

const spanSaldo = document.querySelector('#saldo');
const spanRestante = document.querySelector('#restante');
const botonComprar = document.querySelector('#boton-comprar');

function calcularTotal() {
    let total = 0;
    document.querySelectorAll('.total').forEach(precio => {
        total += convertirCadenaADinero(precio.textContent);
    })
    let saldo = convertirCadenaADinero(spanSaldo.textContent);
    let restante = saldo - total;
    console.log(total, saldo, restante)
    spanTotalGlobal.textContent = formatearDinero(total);
    if(restante < 0){
        spanRestante.textContent = 'Saldo Insuficiente';
        botonComprar.disabled = true;
    } else {
        spanRestante.textContent = formatearDinero(restante);
        botonComprar.disabled = false;
    }
}

const formComprar = document.querySelector('#form-comprar');
formComprar.addEventListener('submit', (e) => {
    e.preventDefault();
    Swal.fire({
        title: "¿Estás seguro que quieres comprar?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1e40af",
        cancelButtonColor: "#991b1b",
        confirmButtonText: "¡Sí, quiero comprarlo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          e.target.submit();
        }
      });
})