const divAlertas = document.getElementById('alertas');

function mostrarAlertas(alertas) {
    limpiarAlertas();
    alertas.forEach(alerta => {
        const alertaHTML = document.createElement('p');
        alertaHTML.textContent = alerta.mensaje;
        alertaHTML.classList.add('border-l-4', 'text-white' , 'p-1', 'font-bold', 'uppercase');
        if(alerta.tipo === 'error') {
            alertaHTML.classList.add('border-red-900', 'bg-red-700');
        } else {
            alertaHTML.classList.add('border-lime-900', 'bg-lime-600');
        }
        divAlertas.appendChild(alertaHTML);
    });
}

function limpiarAlertas() {
    divAlertas.innerHTML = '';
}