<?php

namespace Model;

class Compra extends ActiveRecord {
    protected static $tabla = 'compras';
    protected static $columnasDB = ['id', 'usuario_id', 'fecha'];

    public $id;
    public $usuario_id;
    public $fecha;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->fecha = $args['fecha'] ?? null;
    }
}
