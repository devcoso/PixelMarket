formulario = document.getElementById('formulario');
boton = document.getElementById('boton');
token = new URL(window.location.href).searchParams.get('token');

formulario.addEventListener('submit', function(e) {
    password = document.getElementById('password').value; 
    password2 = document.getElementById('password2').value; 
    e.preventDefault();
    if(validarFormulario(password, password2)) {
        const datos = new FormData(formulario);
        datos.append('password', password);
        datos.append('password2', password2);
        boton.disabled = true;
        fetch(`/reestablecer?token=${token}`, {
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
                mostrarAlertas([{tipo: 'exito', mensaje: 'Contraseña reestablecida correctamente'}]);
                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            }
        })
        .catch(error => {
            console.log(error);
            mostrarAlertas([{tipo: 'error', mensaje: 'Ocurrió un error al intentar iniciar sesión'}]);
            boton.disabled = false;
        });
    }
});

function validarFormulario(password, password2) {
    limpiarAlertas();
    if(password == '' || password2 == '') {
        mostrarAlertas([{tipo: 'error', mensaje: 'Todos los campos son obligatorios'}]);
        return false;
    }
    if(password != password2) {
        mostrarAlertas([{tipo: 'error', mensaje: 'Las contraseñas no coinciden'}]);
        return false;
    }
    return true;
}