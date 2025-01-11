<?php

namespace App\Http\Responsables\productos;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoShow implements Responsable
{
    use ApiResponser;

    public function toResponse($request)
    {}

    public function findAll()
    {
        try {

            $productos = DB::table('productos')
                ->join('categorias', 'categorias.id', '=', 'productos.categoria_id')
                ->select(
                    'productos.id',
                    'productos.codigo',
                    'productos.nombre',
                    'productos.precio',
                    'productos.estado',
                    'categorias.nombre as categoria'
                )
                ->where('productos.estado', 1)
                ->get();
            
            if(count($productos) > 0)
            {
                return $this->successResponse([
                    'message' => 
                            $productos
                ], 200);

            } else {
                return $this->successResponse([
                    'message' => 
                            "Ha ocurrido un error consultando los productos,intente de nuevo, si el problema persiste contacte a Soporte!"
                ], 200);                    
            }

        } catch (Exception $e)
        {
            return $this->successResponse([
                'message' => 
                        "Ha ocurrido un error de base de datos, intente de nuevo!"
            ], 200);
        }
    }

    public function findById($id)
    {
        try
        {
            $producto = DB::table('productos')
                ->select(
                    'productos.id',
                    'productos.codigo',
                    'productos.nombre',
                    'productos.precio',
                    'productos.estado',
                    'productos.categoria_id'
                )
                ->where('productos.estado', 1)
                ->where('productos.id', $id)
                ->get();

            if(count($producto) > 0)
            {
                return $this->successResponse([
                    'message' => 
                            $producto
                ], 200);

            } else {
                return $this->successResponse([
                    'message' => 
                            "Ha ocurrido un error consultando el producto,intente de nuevo, si el problema persiste contacte a Soporte!"
                ], 200);                    
            }

        } catch (Exception $e)
        {
            return $this->successResponse([
                'message' => 
                        "Ha ocurrido un error de base de datos, intente de nuevo!"
            ], 200);
        }
    }
}