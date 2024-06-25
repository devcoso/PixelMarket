<?php

namespace Controllers;

use DateTime;
use MVC\Router;
use Model\Compra;
use Model\Usuario;
use Model\Producto;
use Model\Categorias;
use Classes\Paginacion;
use Model\CompraProducto;

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

    public static function compras(Router $router) {
        if(!is_admin()){
            header('Location: /');
            return;
        }
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1){
            header('Location: /admin/compras?page=1');
        }
        $registros_por_pagina = 30;
        $total = Compra::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        if($paginacion->total_paginas() < $pagina_actual && $paginacion->total_paginas() != 0   ) {
            header('Location: /admin/compras?page=1');
        }
        $compras = Compra::paginar($registros_por_pagina, $paginacion->offset(), 'DESC');
        foreach($compras as $compra){
            $compra->fecha = new DateTime($compra->fecha);
            $compra->fecha->modify('-6 hours');
            $compra->total = 0;
            $productos = CompraProducto::whereAll('compra_id', $compra->id);
            foreach($productos as $producto){
                $compra->total += $producto->pagado;
            }
            $compra->usuario = Usuario::find($compra->usuario_id);
        }
        $router->render('admin/compras', [
            'titulo' => 'Compras',
            'compras' => $compras,
            'paginacion' => $paginacion->paginacion()
        ], 'admin');
    }

    public static function compra(Router $router) {
        if(!is_admin()){
            header('Location: /');
            return;
        }
        $id = intval($_GET['id'] ?? null);
        if(!$id) {
            header('Location: /admin/compras');
        }
        $compra = Compra::find($id);
        if(!$compra) {
            header('Location: /admin/compras');
        }
        $compra->fecha = new DateTime($compra->fecha);
        $compra->fecha->modify('-6 hours');
        $productos = CompraProducto::whereAll('compra_id', $compra->id);
        $pagado = 0;
        $cantitad_total = 0;
        foreach($productos as $producto){
            $producto->producto = Producto::find($producto->producto_id);
            $categoria= Categorias::find($producto->producto->categoria_id);
            $producto->producto->categoria = $categoria->nombre;
            $pagado += $producto->pagado;
            $cantitad_total += $producto->cantidad;
        }
        $compra->pagado = $pagado;
        $compra->cantidad = $cantitad_total;
        $usuario = Usuario::find($compra->usuario_id);
        $router->render('admin/compra', [
            'titulo' => 'Compra #' . $compra->id,
            'compra' => $compra,
            'usuario' => $usuario,
            'productos' => $productos
        ], 'admin');
    }

    public static function usuarios(Router $router) {
        if(!is_admin()){
            header('Location: /');
            return;
        }
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1){
            header('Location: /admin/usuarios?page=1');
        }
        $registros_por_pagina = 30;
        $total = Usuario::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        if($paginacion->total_paginas() < $pagina_actual && $paginacion->total_paginas() != 0   ) {
            header('Location: /admin/usuarios?page=1');
        }
        $usarios = Usuario::paginar($registros_por_pagina, $paginacion->offset(), 'DESC');
        $router->render('admin/usuarios', [
            'titulo' => 'Usuarios',
            'usuarios' => $usarios,
            'paginacion' => $paginacion->paginacion()
        ], 'admin');
    }   

    public static function productos(Router $router) {
        if(!is_admin()){
            header('Location: /');
            return;
        }
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1){
            header('Location: /admin/productos?page=1');
        }
        $registros_por_pagina = 30;
        $total = Producto::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        if($paginacion->total_paginas() < $pagina_actual && $paginacion->total_paginas() != 0   ) {
            header('Location: /admin/productos?page=1');
        }
        $productos = Producto::paginar($registros_por_pagina, $paginacion->offset());
        foreach($productos as $producto){
            $producto->ventas = 0;
            $compras = CompraProducto::whereAll('producto_id', $producto->id);
            foreach($compras as $compra){
                $producto->ventas += $compra->cantidad;
            }
        }
        $router->render('admin/productos', [
            'titulo' => 'Productos',
            'productos' => $productos,
            'paginacion' => $paginacion->paginacion()
        ], 'admin');
    }

    public static function categorias(Router $router) {
        if(!is_admin()){
            header('Location: /');
            return;
        }
        $categorias = Categorias::all();
        foreach($categorias as $categoria){
            $categoria->stock = 0;
            $categoria->ventas = 0;
            $productos = Producto::whereAll('categoria_id', $categoria->id);
            foreach($productos as $producto){
                $categoria->stock += $producto->stock;
                $compras = CompraProducto::whereAll('producto_id', $producto->id);
                foreach($compras as $compra){
                    $categoria->ventas += $compra->cantidad;
                }
            }   
        }
        //Ordenar arreglo por mayour ventas
        usort($categorias, function($a, $b){
            return $b->ventas <=> $a->ventas;
        });
        $router->render('admin/categorias', [
            'titulo' => 'Categorías',
            'categorias' => $categorias
        ], 'admin');
    }

    public static function dashboard(Router $router) {
        if(!is_admin()){
            echo json_encode([
                'ok' => false,
                'mensaje' => 'No tienes permisos para realizar esta acción'
            ]);
        }
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