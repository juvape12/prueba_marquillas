<?php

namespace App\Http\Responsables\productos;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoDelete implements Responsable
{
    use ApiResponser;

    public function toResponse($request)
    {
        try
        {
            DB::connection('mysql')->beginTransaction();
            $idProducto = $request->id_producto;
    
            $producto = Producto::find($idProducto);
            $producto->delete();
            DB::connection('mysql')->commit();

            return $this->successResponse([
                'message' => 
                        "Producto Eliminado Correctamente!"
            ], 200);

            
        } catch (Exception $e)
        {
            return $this->successResponse([
                'message' => 
                        "Ha ocurrido un error de base de datos, intente de nuevo!"
            ], 200);
        }


    }
}