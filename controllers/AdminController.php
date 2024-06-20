<?php

namespace Controllers;

use MVC\Router;

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
}