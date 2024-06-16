<?php

namespace Controllers;

use MVC\Router;

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
    public static function carrito(Router $router) {
        // Render a la vista 
        $router->render('main/carrito', [
            'titulo' => 'Carrito',
        ]);
    }

    public static function perfil(Router $router) {
        // Render a la vista 
        $router->render('main/perfil', [
            'titulo' => 'Perfil',
        ]);
    }
}