formulario = document.getElementById('formulario');
boton = document.getElementById('boton');

formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    nombre = document.getElementById('nombre').value;
    apellido = document.getElementById('apellido').value;
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;
    password2 = document.getElementById('password2').value; 
    if(validarFormulario(email, password, password2, nombre, apellido)) {
        const datos = new FormData(formulario);
        datos.append('nombre', nombre);
        datos.append('apellido', apellido);
        datos.append('email', email);
        datos.append('password', password);
        datos.append('password2', password2);
        boton.disabled = true;
        fetch('/registro', {
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
                window.location.href = '/mensaje';
            }
        })
        .catch(error => {
            console.log(error);
            mostrarAlertas([{tipo: 'error', mensaje: 'Ocurrió un error al intentar iniciar sesión'}]);
            boton.disabled = false;
        });
    }
});

function validarFormulario(email, password, password2, nombre, apellido) {
    limpiarAlertas();
    if(email == '' || password == '' || password2 == '' || nombre == '' || apellido == '') {
        mostrarAlertas([{tipo: 'error', mensaje: 'Todos los campos son obligatorios'}]);
        return false;
    }
    if(password != password2) {
        mostrarAlertas([{tipo: 'error', mensaje: 'Las contraseñas no coinciden'}]);
        return false;
    }
    return true;
}