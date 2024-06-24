<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIProductos;
use Controllers\AuthController;
use Controllers\CarritoController;
use Controllers\MainPaginasController;
use Controllers\AdminController;

$router = new Router();

// ---- Auth ----
// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);
// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);
// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);
// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);
// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);
// ---- Main ----
$router->get('/', [MainPaginasController::class, 'index']);
$router->get('/producto', [MainPaginasController::class, 'producto']);
$router->get('/destacados', [MainPaginasController::class, 'destacados']);
$router->get('/categorias', [MainPaginasController::class, 'categorias']);
//Acciones de Usuario
$router->get('/perfil', [MainPaginasController::class, 'perfil']);
$router->get('/compras', [MainPaginasController::class, 'compras']);
$router->get('/compra', [MainPaginasController::class, 'compra']);
$router->get('/compra/Comprobante', [MainPaginasController::class, 'PDF']);
// Carrito
$router->get('/carrito', [CarritoController::class, 'carrito']);
$router->post('/carrito', [CarritoController::class, 'agregar']);
$router->post('/carrito/editar', [CarritoController::class, 'editar']);
$router->post('/carrito/eliminar', [CarritoController::class, 'eliminar']);
$router->post('/carrito/comprar', [CarritoController::class, 'comprar']);
// API Productos
$router->get('/api/productos', [APIProductos::class, 'getProductos']);
$router->get('/api/productos/valoracion', [APIProductos::class, 'getProductosPorValoracion']);
$router->get('/api/categorias', [APIProductos::class, 'getCategorias']);
// ---- Admin ----
$router->get('/admin', [AdminController::class, 'index']);
$router->post('/admin/producto/stock', [AdminController::class, 'actualizarStock']);


$router->comprobarRutas();