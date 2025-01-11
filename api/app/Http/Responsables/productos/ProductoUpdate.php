<?php

namespace App\Http\Responsables\productos;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoUpdate implements Responsable
{
    use ApiResponser;

    public function toResponse($request)
    {
        DB::connection('mysql')->beginTransaction();
        $datosRegistro = $request->all();

        $codigo = trim($datosRegistro['codigo']);
        $nombre = trim($datosRegistro['nombre']);
        $categoriaID = $datosRegistro['categoria_id'];
        $precio = trim($datosRegistro['precio']);
        $id = $datosRegistro['id_producto'];

        if($precio <= 0)
        {
            return $this->successResponse([
                'message' => 
                        "El precio ingresado debe ser mayor a cero, verifique e intente de nuevo."
            ], 200);
        }

        if((isset($codigo) && empty($codigo) || is_null($codigo)) ||
           (isset($nombre) && empty($nombre) || is_null($nombre)) || 
           (isset($categoriaID) && empty($categoriaID) || is_null($categoriaID)) ||
           (isset($precio) && empty($precio) || is_null($precio)))
        {
            return $this->successResponse([
                'message' => 
                        "Los siguiente campos son obligatorios: codigo, nombre, categoria y precio, verifique e intente de nuevo."
            ], 200);

        } else
        {
            try {

                $verificacionNombreProducto = $this->validacionNombre(strtoupper($nombre), $id);
                $verificacionCategoria = $this->validacionCategoria($categoriaID);

                if($verificacionNombreProducto == 0 && $verificacionCategoria > 0)
                {
                    $Producto = Producto::where('id', $id)
                        ->update([
                            'codigo' =>$codigo,
                            'nombre' => strtoupper($nombre),
                            'categoria_id' => $categoriaID,
                            'precio' => $precio
                        ]);
                    
                    if($Producto)
                    {
                        DB::connection('mysql')->commit();
                        return $this->successResponse([
                            'message' => 
                                    "Producto Actualizado Correctamente!"
                        ], 200);
    
                    } else {
                        DB::connection('mysql')->rollback();
                        return $this->successResponse([
                            'message' => 
                                    "Ha ocurrido un error actualizando el producto,intente de nuevo, si el problema persiste contacte a Soporte!"
                        ], 200);                    
                    }
                } else {
                    DB::connection('mysql')->rollback();
                    return $this->successResponse([
                        'message' => 
                                "Ya existe un producto con el mismo nombre ingresado o no existe la categoria!"
                    ], 200); 
                }
                

            } catch (Exception $e)
            {
                DB::connection('mysql')->rollback();
                return $this->successResponse([
                    'message' => 
                            "Ha ocurrido un error de base de datos, intente de nuevo!" . $e
                ], 200);
            }
        }
    }

    public function validacionNombre($nombre, $id)
    {
        return Producto::where('nombre', $nombre)
                ->whereNotIn('id', array($id))
                ->get()
                ->count();
    }

    public function validacionCategoria($id)
    {
        return Categoria::where('id', $id)
                ->get()
                ->count();
    }
}