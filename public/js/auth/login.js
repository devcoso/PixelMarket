formulario = document.getElementById('formulario');
boton = document.getElementById('boton');

formulario.addEventListener('submit', function(e) {
    email = document.getElementById('email').value;
    password = document.getElementById('password').value; 
    e.preventDefault();
    if(validarFormulario(email, password)) {
        const datos = new FormData(formulario);
        datos.append('email', email);
        datos.append('password', password);
        boton.disabled = true;
        fetch('/login', {
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
                window.location.href = '/';
            }
        })
        .catch(error => {
            console.log(error);
            mostrarAlertas([{tipo: 'error', mensaje: 'Ocurrió un error al intentar iniciar sesión'}]);
            boton.disabled = false;
        });
    }
});

function validarFormulario(email, password) {
    limpiarAlertas();
    if(email == '' || password == '') {
        mostrarAlertas([{tipo: 'error', mensaje: 'Todos los campos son obligatorios'}]);
        return false;
    }
    return true;
}