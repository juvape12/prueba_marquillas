<?php

namespace App\Models\Categorias;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'nombre',
    ];
}
