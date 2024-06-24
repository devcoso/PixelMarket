<?php

namespace Controllers;

use MVC\Router;
use Model\Compra;
use Model\Carrito;
use Model\Usuario;
use Model\CompraProducto;
use Model\Producto;

class CarritoController {
    public static function carrito(Router $router) {
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
        if(!is_auth()) {
            header('Location: /login');
            return;
        }
        $tipo = $_GET['tipo'] ?? null;
        $mensaje = $_GET['mensaje'] ?? null;
        $carrito = Carrito::whereAll('usuario_id', $_SESSION['id']);
        foreach($carrito as $item) {
            $item->producto = Producto::find($item->producto_id);
        }
        $usuario = Usuario::find($_SESSION['id']);
        $saldo = $usuario->saldo;
        // Render a la vista 
        $router->render('main/carrito', [
            'titulo' => 'Carrito',
            'carrito' => $carrito,
            'mensaje' => $mensaje,
            'tipo' => $tipo,
            'saldo' => $saldo
        ]);
    }

    public static function agregar() {
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
        if(!is_auth()) {
            header('Location: /login');
            return;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header('Location: /');
            }
            $producto = Producto::find($id);
            if(!$producto) {
                header('Location: /');
                return;
            }
            $carrito = Carrito::whereArray(['usuario_id' => $_SESSION['id'], 'producto_id' => $id]);
            if($carrito) {
                $producto = Producto::find($carrito->producto_id);
                if($producto->stock < 1 || $producto->stock < $carrito->cantidad + 1) {
                    header('Location: /carrito?mensaje=No hay stock suficiente&tipo=error');
                    return;
                }
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
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
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
                
                $producto = Producto::find($carrito->producto_id);
                if($producto->stock < $carrito->cantidad) {
                    echo json_encode(['error' => 'No hay stock suficiente', 'ok' => false]);
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
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
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
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
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
            $bandera = false;
            foreach($carrito as $item) {
                $item->producto = Producto::find($item->producto_id);
                $item->producto->stock -= $item->cantidad;
                $total += $item->producto->precio * $item->cantidad;
                if($item->producto->stock < 0) {
                    $bandera = true;
                    $itemSinStock = Carrito::whereArray(['usuario_id' => $_SESSION['id'], 'producto_id' => $item->producto_id]);
                    $itemSinStock->eliminar();
                }
            }
            if($bandera) {
                header('Location: /carrito?mensaje=No hay stock suficiente&tipo=error');
                return;
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
                $producto = Producto::find($item->producto_id);
                $producto->stock -= $item->cantidad;
                $compra_producto->cantidad = $item->cantidad;
                $compra_producto->pagado = $item->producto->precio * $item->cantidad;
                $resultado = $producto->guardar();
                if(!$resultado) {
                    header('Location: /carrito?mensaje=Error al comprar&tipo=error');
                    return;
                }
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