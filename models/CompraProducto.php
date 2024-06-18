<?php

namespace Model;

class CompraProducto extends ActiveRecord {
    protected static $tabla = 'compra_producto';
    protected static $columnasDB = ['id', 'compra_id', 'producto_id', 'cantidad'];

    public $id;
    public $compra_id;
    public $producto_id;
    public $cantidad;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->compra_id = $args['compra_id'] ?? null;
        $this->producto_id = $args['producto_id'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
    }
}
