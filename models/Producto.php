<?php

namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'stock', 'categoria_id', 'descripcion', 'marca', 'valoracion', 'thumbnail', 'imagen', 'dimension_ancho', 'dimension_alto', 'dimension_largo'];

    public $id;
    public $titulo;
    public $precio;
    public $stock;
    public $categoria_id;
    public $descripcion;
    public $marca;
    public $valoracion;
    public $thumbnail;
    public $imagen;
    public $dimension_ancho;
    public $dimension_alto;
    public $dimension_largo;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->stock = $args['stock'] ?? null;
        $this->precio = $args['precio'] ?? 0;
        $this->categoria_id = $args['categoria_id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->valoracion = $args['valoracion'] ?? 0;
        $this->thumbnail = $args['thumbnail'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->dimension_ancho = $args['dimension_ancho'] ?? 0;
        $this->dimension_alto = $args['dimension_alto'] ?? 0;
        $this->dimension_largo = $args['dimension_largo'] ?? 0;
    }
}
