<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $connection = 'mysql';
    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'codigo', 'nombre', 'categoria_id', 'precio', 'estado'
    ];
}
