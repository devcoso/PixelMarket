formulario = document.getElementById('formulario');
boton = document.getElementById('boton');

formulario.addEventListener('submit', function(e) {
    email = document.getElementById('email').value;
    e.preventDefault();
    if(validarFormulario(email)) {
        const datos = new FormData(formulario);
        datos.append('email', email);
        boton.disabled = true;
        fetch('/olvide', {
            method: 'POST',
            body: datos
        })
        .then(res => res.json())
        .then(data => {
            if(data.error) {
                console.log(data.error);
                const alertas = data.error.map(error => ({tipo: 'error', mensaje: error}));
                mostrarAlertas(alertas);
                boton.disabled = false;
            }
            if(data.exito){
                const alertas = data.exito.map(error => ({tipo: 'exito', mensaje: error}));
                mostrarAlertas(alertas);
            }
        })
        .catch(error => {
            console.log(error);
            mostrarAlertas([{tipo: 'error', mensaje: 'Ocurrió un error al intentar iniciar sesión'}]);
            boton.disabled = false;
        });
    }
});

function validarFormulario(email) {
    limpiarAlertas();
    if(email == '') {
        mostrarAlertas([{tipo: 'error', mensaje: 'El campo email es obligatorio'}]);
        return false;
    }
    return true;
}