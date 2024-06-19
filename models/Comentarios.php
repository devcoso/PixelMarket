<?php

namespace Model;

class Comentarios extends ActiveRecord {
    protected static $tabla = 'comentarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'comentario', 'valoracion', 'producto_id'];

    public $id;
    public $nombre;
    public $email;
    public $comentario;
    public $valoracion;
    public $producto_id;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->comentario = $args['comentario'] ?? '';
        $this->valoracion = $args['valoracion'] ?? 0;
        $this->producto_id = $args['producto_id'] ?? 0;
    }
}
