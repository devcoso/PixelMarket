<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;

class AdminController {
    public static function index(Router $router) {
        if(!is_admin()){
            header('Location: /');
            return;
        }
        $router->render('admin/index', [
            'titulo' => 'Panel de Administración',
        ], 'admin');
    }



    public static function actualizarStock(){
        if(!is_admin()){
            echo json_encode([
                'ok' => false,
                'mensaje' => 'No tienes permisos para realizar esta acción'
            ]);
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $stock = $_POST['stock'];
            if($stock < 0){
                echo json_encode([
                    'ok' => false,
                    'mensaje' => 'El stock no puede ser negativo'
                ]);
                return;
            }
            if($stock === '' || $id === ''){
                echo json_encode([
                    'ok' => false,
                    'mensaje' => 'Todos los campos son obligatorios'
                ]);
                return;
            }
            $producto = Producto::find($id);
            $producto->stock = $stock;
            $resultado = $producto->actualizar();

            if($resultado){
                echo json_encode([
                    'ok' => true,
                    'mensaje' => 'Stock actualizado'
                ]);
            } else {
                echo json_encode([
                    'ok' => false,
                    'mensaje' => 'Hubo un error al actualizar el stock'
                ]);
            }
        }
    }
    
}