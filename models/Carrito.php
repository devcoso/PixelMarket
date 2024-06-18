<?php

namespace Model;

class Carrito extends ActiveRecord {
    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id', 'usuario_id', 'producto_id', 'cantidad'];

    public $id;
    public $usuario_id;
    public $producto_id;
    public $cantidad;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 1;
    }
}
