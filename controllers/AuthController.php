<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {
        if(is_auth()) header('Location: /');

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();
            
            if(empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = Usuario::where('email', $usuario->email);
                if(!$usuario || !$usuario->confirmado ) {
                    Usuario::setAlerta('error', 'Usuario no encontrado o cuenta no confirmada');
                } else {
                    // El Usuario existe
                    if( password_verify($_POST['password'], $usuario->password) ) {
                        
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['saldo'] = $usuario->saldo;
                        $_SESSION['admin'] = $usuario->admin ?? null;
                        Usuario::setAlerta('exito', 'Has iniciado sesión');
                    } else {
                        Usuario::setAlerta('error', 'Credenciales no válidas');
                    }
                }
                $alertas = Usuario::getAlertas();
            }
            // Establecer el encabezado de contenido a JSON
            header('Content-Type: application/json');
            // Convertir el array a JSON y retornarlo
            echo json_encode($alertas);
            return;
        }
        
        // Render a la vista 
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
        ], "auth");
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        } 
    }

    public static function registro(Router $router) {
        if(is_auth()) header('Location: /');

        $alertas = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->validar_cuenta();

            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    

                    if($resultado) {
                        Usuario::setAlerta('exito', 'Usuario Creado Correctamente');
                    } else {
                        Usuario::setAlerta('error', 'Error al crear el usuario');
                    }
                }
                $alertas = Usuario::getAlertas();
            }
            // Establecer el encabezado de contenido a JSON
            header('Content-Type: application/json');
            // Convertir el array a JSON y retornarlo
            echo json_encode($alertas);
            return;
        }

        // Render a la vista
        $router->render('auth/registro', [
            'titulo' => 'Regístrate',	
            'usuario' => $usuario, 
        ], "auth");
    }

    public static function olvide(Router $router) {
        if(is_auth()) header('Location: /');
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {

                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    $email->enviarInstrucciones();


                    // Imprimir la alerta
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                }
                $alertas = Usuario::getAlertas();
            }
            // Establecer el encabezado de contenido a JSON
            header('Content-Type: application/json');
            // Convertir el array a JSON y retornarlo
            echo json_encode($alertas);
            return;
        }

        // Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
        ], "auth");
    }

    public static function reestablecer(Router $router) {
        $token = s($_GET['token']);
        $token_valido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarPassword();

            if(empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el Token
                $usuario->token = null;

                // Guardar el usuario en la BD
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    Usuario::setAlerta('exito', 'Password Actualizado Correctamente');
                } else {
                    Usuario::setAlerta('error', 'Error al actualizar el password');
                }
                $alertas = Usuario::getAlertas();
            }
            // Establecer el encabezado de contenido a JSON
            header('Content-Type: application/json');
            // Convertir el array a JSON y retornarlo
            echo json_encode($alertas);
            return;
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'token_valido' => $token_valido
        ], "auth");
    }

    public static function mensaje(Router $router) {
        if(is_auth()) header('Location: /');

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ], "auth");
    }

    public static function confirmar(Router $router) {
        if(is_auth()) header('Location: /');

        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        $alerta = false;

        if(empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlerta('error', 'Token No Válido');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            // Guardar en la BD
            $usuario->guardar();

            $alerta = true;
        }

        $router->render('auth/confirmar', [
            'titulo' => 'Confirmando cuenta en PixelMarket',
            'alerta' => $alerta
        ] , "auth");
    }
}