<?php

namespace Controllers;

use DateTime;
use MVC\Router;
use Model\Compra;
use Dompdf\Dompdf;
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
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
        if(!is_auth()) {
            header('Location: /login');
        }
        $id = intval($_SESSION['id'] ?? null);
        if(!$id) {
            header('Location: /login');
        }
        $usuario = Usuario::find($id);
        // Render a la vista 
        $router->render('main/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario
        ]);
    }

    public static function compras(Router $router) {
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
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

    public static function compra(Router $router) {
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
        if(!is_auth()) {
            header('Location: /login');
        }
        $id = intval($_GET['id'] ?? null);
        if(!$id) {
            header('Location: /compras');
        }
        $compra = Compra::find($id);
        if(!$compra) {
            header('Location: /compras');
        }
        if($compra->usuario_id != $_SESSION['id']) {
            header('Location: /compras');
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
        // Render a la vista
        $router->render('main/compra', [
            'titulo' => 'Compra',
            'compra' => $compra,
            'productos' => $productos
        ]);
    }

    public static function PDF() {
        if(is_admin()) {
            header('Location: /admin');
            return;
        }
        if(!is_auth()) {
            header('Location: /login');
        }
        $id = intval($_GET['id'] ?? null);
        if(!$id) {
            header('Location: /compras');
        }
        $compra = Compra::find($id);
        if(!$compra) {
            header('Location: /compras');
        }
        if($compra->usuario_id != $_SESSION['id']) {
            header('Location: /compras');
        }
        $compra->fecha = new DateTime($compra->fecha);
        $compra->fecha->modify('-6 hours');
        $productos = CompraProducto::whereAll('compra_id', $compra->id);
        $pagado = 0;
        $cantitad_total = 0;
        foreach($productos as $producto){
            $producto->producto = Producto::find($producto->producto_id);
            $pagado += $producto->pagado;
            $cantitad_total += $producto->cantidad;
        }
        $compra->pagado = number_format($pagado, 2, '.', ',');
        $compra->cantidad = $cantitad_total;
        $dompdf = new Dompdf();
        $fecha = $compra->fecha->format('Y-m-d');
        $hora = $compra->fecha->format('H:i:s');
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellido'];
        $html = "<!DOCTYPE html>
        <html lang=\"es\">
        <head>
            <style>
            body {
                font-family: sans-serif;
                background-color: #fff;
            }
            h1 {
                color: #3f3f46;
                font-family: sans-serif;
                text-align: center;
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }
            h2 {
                color: #3f3f46;
                text-align: center;
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }
            h3 {
                color: #3f3f46;
                font-size: 1.25rem;
                font-weight: 700;
                text-align: center;
                margin-bottom: 1rem;
            }
            span {
                color: #09090b;
                font-weight: 700;
            }
            p {
                color: #27272a;
                font-size: 1rem;
                font-weight: 400;
                text-align: center;
                margin-bottom: 1rem;
            }
            a {
                color: #27272a;
                font-size: 1rem;
                font-weight: 700;
                text-decoration: none;
            }
            a:hover {
                color: #27272a;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 1rem;
            }
            th {
                background-color: #f5f5f5;
                color: #3f3f46;
                font-weight: 700;
                text-align: center;
                padding: 0.5rem;
            }
            td {
                border: 1px solid #f5f5f5;
                padding: 0.5rem;
                text-align: center;
            }
        </style>
        </head>
        <body>
            <h1>Pixel Market</h1>
            <p>Estimado/a <span>$nombre</span>, gracias por tu compra.</p>
            <p>¡Aquí está tu comprobante de compra!</p>
            <h2>Comprobante de compra <span>#$compra->id</span></h2>
            <p>Fecha: <span>$fecha</span></p>
            <p>Hora: <span>$hora</span></p>
            <h3>Productos</h3>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
        ";
        foreach($productos as $producto){
            $cantidad = $producto->cantidad;
            $pagado = number_format($producto->pagado, 2, '.', ',');
            $precio = number_format($producto->producto->precio, 2, '.', ',');
            $producto = $producto->producto;
            $html .= "
                        <tr>
                            <td>
                                <h4>$producto->titulo</h4>
                            </td>
                            <td>$cantidad</td>
                            <td>$<span>$precio</span></td>
                            <td>$<span>$pagado</span></td>
                        </tr>
            ";
        }
        $html .= "
                    </tbody>
                </table>
            </div>
            <p style=\"font-size: 1.4rem;\">Cantidad de artículos: <span>$compra->cantidad</span></p>
            <p style=\"font-size: 2rem;\">Total:$<span>$compra->pagado</span></p>
        </body>
        </html>";
        $dompdf->loadHtml($html);
        $dompdf->render();
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=compra$compra->id.pdf");
        echo $dompdf->output();
    }
}