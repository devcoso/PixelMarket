<?php

namespace Controllers;

use DateTime;
use MVC\Router;
use Model\Compra;
use Model\Usuario;
use Model\Producto;
use Model\Categorias;
use Model\Comentarios;
use Model\CompraProducto;

class MainPaginasController {
    public static function index(Router $router) {

        // Render a la vista 
        $router->render('main/index', [
            'titulo' => 'Incio',
        ]);
    }

    public static function destacados(Router $router) {
        // Render a la vista 
        $router->render('main/destacados', [
            'titulo' => 'Destacados',
        ]);
    }

    public static function categorias(Router $router) {
        // Render a la vista 
        $router->render('main/categorias', [
            'titulo' => 'Categorias',
        ]);
    }

    public static function producto(Router $router) {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /');
        }
        //Obtener el producto
        $producto = Producto::find($id);
        if (!$producto) {
            header('Location: /');
        }
        // Obtener las categorias
        $categoria = Categorias::find($producto->categoria_id);
        $producto->categoria = $categoria->nombre;
        $comentarios = Comentarios::whereAll('producto_id', $producto->id);
        $producto->comentarios = $comentarios;
        $router->render('main/producto', [
            'titulo' => 'Producto',
            'producto' => $producto,
        ]);
    }
    
    public static function perfil(Router $router) {
        if(!is_auth()) {
            header('Location: /login');
        }
        $usuario = Usuario::find($_SESSION['id']);
        $saldo = $usuario->saldo;
        // Render a la vista 
        $router->render('main/perfil', [
            'titulo' => 'Perfil',
            'saldo' => $saldo
        ]);
    }

    public static function compras(Router $router) {
        if(!is_auth()) {
            header('Location: /login');
        }
        $tipo = $_GET['tipo'] ?? null;
        $mensaje = $_GET['mensaje'] ?? null;
        date_default_timezone_set('UTC');
        $compras = Compra::whereAll('usuario_id', $_SESSION['id']);
        foreach($compras as $compra){
            $compra->fecha = new DateTime($compra->fecha);
            $compra->fecha->modify('-6 hours');
            $productos = CompraProducto::whereAll('compra_id', $compra->id);
            $pagado = 0;
            $cantitad_total = 0;
            foreach($productos as $producto){  
                $pagado += $producto->pagado;
                $cantitad_total += $producto->cantidad;
            }
            $compra->pagado = $pagado;
            $compra->cantidad = $cantitad_total;
            $producto1 = Producto::find($productos[0]->producto_id);
            $compra->imagen = $producto1->thumbnail;
        }
        // Render a la vista 
        $router->render('main/compras', [
            'titulo' => 'Compras',
            'mensaje' => $mensaje,
            'tipo' => $tipo,
            'compras' => $compras
        ]);
    }

}