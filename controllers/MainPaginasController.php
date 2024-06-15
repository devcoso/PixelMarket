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
}