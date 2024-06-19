<?php

namespace Controllers;

use Model\Categorias;
use Model\Producto;

class APIProductos {
    public static function getProductos() {
        $productos = Producto::orderBy('id', 'ASC');
        header('Content-Type: application/json');
        echo json_encode($productos);
    }

    public static function getProductosPorValoracion() {
        $productos = Producto::orderBy('valoracion', 'DESC');
        header('Content-Type: application/json');
        echo json_encode($productos);
    }
    public static function getCategorias() {
        $categorias = Categorias::orderBy('id', 'ASC');
        header('Content-Type: application/json');
        echo json_encode($categorias);
    }
}