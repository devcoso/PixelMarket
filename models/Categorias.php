<?php

namespace Model;

class Categorias extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'slug', 'nombre'];

    public $id;
    public $slug;
    public $nombre;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->slug = $args['slug'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
    }
}
