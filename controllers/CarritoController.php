<?php

namespace Controllers;

use MVC\Router;
use Model\Compra;
use Model\Carrito;
use Model\Usuario;
use Model\CompraProducto;

class CarritoController {
    public static function carrito(Router $router) {
        if(!is_auth()) {
            header('Location: /login');
            return;
        }
        $tipo = $_GET['tipo'] ?? null;
        $mensaje = $_GET['mensaje'] ?? null;
        $carrito = Carrito::whereAll('usuario_id', $_SESSION['id']);
        foreach($carrito as $producto) {
            $url = "https://dummyjson.com/products/$producto->producto_id?select=id,title,category,price,thumbnail";
            // Obtener el contenido del archivo JSON
            $json = file_get_contents($url);
            // Verificar si se obtuvo el contenido correctamente
            if ($json === FALSE) {
                header('Location: /carrito?mensaje=Producto no encontrado&tipo=error');
                return;
            }
            $producto->producto = json_decode($json);
        }
        $usuario = Usuario::find($_SESSION['id']);
        $saldo = $usuario->saldo;
        // Render a la vista 
        $router->render('main/carrito', [
            'titulo' => 'Carrito',
            'mensaje' => $mensaje,
            'tipo' => $tipo,
            'carrito' => $carrito,
            'saldo' => $saldo
        ]);
    }

    public static function agregar() {
        if(!is_auth()) {
            header('Location: /login');
            return;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header('Location: /');
            }
            // Render a la vista 
            $url = "https://dummyjson.com/products/$id?select=id,title,category,brand,description,price,stock,availabilityStatus,rating,images,thumbnail,dimensions,reviews";
            // Obtener el contenido del archivo JSON
            $json = file_get_contents($url);
            // Verificar si se obtuvo el contenido correctamente
            if ($json === FALSE) {
                header('Location: /carrito?mensaje=Producto no encontrado&tipo=error');
                return;
            }
            $carrito = Carrito::whereArray(['usuario_id' => $_SESSION['id'], 'producto_id' => $id]);
            if($carrito) {
                if($carrito->cantidad >= 10) {
                    header('Location: /carrito?mensaje=No puedes agregar más de 10 productos iguales&tipo=error');
                    return;
                }	
                else {
                    $carrito->cantidad++;
                    $resultado = $carrito->guardar();
                }
            } else {
                $carrito = new Carrito();
                $carrito->usuario_id = $_SESSION['id'];
                $carrito->producto_id = $id;
                $carrito->cantidad = 1;
                $resultado = $carrito->guardar();
            }
            if(!$resultado) {
                header('Location: /carrito?mensaje=Error al agregar al carrito&tipo=error');
                return;
            } 
            header('Location: /carrito?mensaje=Producto agregado al carrito correctamente&tipo=success');
        }
    }

    public static function editar() {
        
        if(!is_auth()) {
            echo json_encode(['error' => 'No tienes permisos', 'ok' => false]);
            return;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Establecer el encabezado de contenido a JSON
            header('Content-Type: application/json');
            $carrito = Carrito::find($_POST['id']);
            if($carrito) {
                $carrito->cantidad = $_POST['cantidad'];
                if($carrito->cantidad > 10 || $carrito->cantidad < 1) {
                    echo json_encode(['error' => 'No puedes agregar más de 10 o menos de 1 productos iguales', 'ok' => false]);
                    return;
                }	
                else {
                    $resultado = $carrito->guardar();
                    if(!$resultado) {
                        echo json_encode(['error' => 'Error al agregar al carrito', 'ok' => false]);
                        return;
                    }
                    echo json_encode(['success' => 'Producto agregado al carrito correctamente', 'ok' => true]);
                    return;
                }
            }
        }
    }

    public static function eliminar() {
        if(!is_auth()) {
            header('Location: /login');
            return;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $carrito = Carrito::find($id);
            if($carrito) {
                $resultado = $carrito->eliminar();
                if(!$resultado) {
                    header('Location: /carrito?mensaje=Error al eliminar del carrito&tipo=error');
                    return;
                }
                header('Location: /carrito?mensaje=Producto eliminado del carrito correctamente&tipo=success');
            }
        }
    }

    public static function comprar() {
        if(!is_auth()) {
            header('Location: /login');
            return;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $carrito = Carrito::whereAll('usuario_id', $_SESSION['id']);
            if(count($carrito) == 0) {
                header('Location: /carrito?mensaje=No hay productos en el carrito&tipo=error');
                return;
            }
            $total = 0;
            foreach($carrito as $item) {
                $url = "https://dummyjson.com/products/$item->producto_id?select=price";
                // Obtener el contenido del archivo JSON
                $json = file_get_contents($url);
                // Verificar si se obtuvo el contenido correctamente
                if ($json === FALSE) {
                    header('Location: /carrito?mensaje=Producto no encontrado&tipo=error');
                    return;
                }
                $item->producto = json_decode($json);
                $total += $item->producto->price * $item->cantidad;
            }

            $usuario = Usuario::find($_SESSION['id']);
            if($usuario->saldo < $total) {
                header('Location: /carrito?mensaje=Saldo insuficiente&tipo=error');
                return;
            }

            $compra = new Compra();
            $compra->usuario_id = $_SESSION['id'];
            $compra->fecha = date('Y-m-d H:i:s', time());
            $resultado = $compra->guardar();
            if(!$resultado) {
                header('Location: /carrito?mensaje=Error al comprar&tipo=error');
                return;
            }
            $compra_id = $resultado['id'];
            foreach($carrito as $item) {
                $compra_producto = new CompraProducto();
                $compra_producto->compra_id = $compra_id;
                $compra_producto->producto_id = $item->producto_id;
                $compra_producto->cantidad = $item->cantidad;
                $compra_producto->pagado = $item->producto->price * $item->cantidad;
                $resultado = $compra_producto->guardar();
                if(!$resultado) {
                    header('Location: /carrito?mensaje=Error al comprar&tipo=error');
                    return;
                }
                $resultado = $item->eliminar();
                if(!$resultado) {
                    header('Location: /carrito?mensaje=Error al comprar&tipo=error');
                    return;
                }
            }
            $usuario->saldo -= $total;
            $resultado = $usuario->guardar();
            if(!$resultado) {
                header('Location: /carrito?mensaje=Error al comprar&tipo=error');
                return;
            }
            header('Location: /compras?mensaje=Compra realizada correctamente&tipo=success');
        }
    }
}