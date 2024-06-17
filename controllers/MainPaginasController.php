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

    public static function producto(Router $router) {
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
            header('Location: /');
        }
        // Decodificar el JSON a un array asociativo de PHP
        $producto = json_decode($json, true);
        $router->render('main/producto', [
            'titulo' => 'Producto',
            'producto' => $producto,
        ]);
    }

    public static function carrito(Router $router) {
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
                header('Location: /');
            }
            

            header('Location: /carrito');
        }
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