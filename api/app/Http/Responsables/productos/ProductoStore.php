<?php

namespace App\Http\Responsables\productos;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoStore implements Responsable
{
    use ApiResponser;

    public function toResponse($request)
    {
        DB::connection('mysql')->beginTransaction();
        $datosRegistro = $request->all();

        $codigo = trim($datosRegistro['codigo']);
        $nombre = trim($datosRegistro['nombre']);
        $categoriaID = trim($datosRegistro['categoria_id']);
        $precio = trim($datosRegistro['precio']);

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

                $verificacionNombreProducto = $this->validacionNombre(strtoupper($nombre));
                $verificacionCategoria = $this->validacionCategoria($categoriaID);

                if($verificacionNombreProducto == 0 && $verificacionCategoria > 0)
                {
                    $Producto = Producto::create([
                        'codigo' =>$codigo,
                        'nombre' => strtoupper($nombre),
                        'categoria_id' =>$categoriaID,
                        'precio' => $precio
                    ]);
                    
                    if($Producto)
                    {
                        DB::connection('mysql')->commit();
                        return $this->successResponse([
                            'message' => 
                                    "Producto Registrado Correctamente!"
                        ], 200);
    
                    } else {
                        DB::connection('mysql')->rollback();
                        return $this->successResponse([
                            'message' => 
                                    "Ha ocurrido un error registrando el producto,intente de nuevo, si el problema persiste contacte a Soporte!"
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
                            "Ha ocurrido un error de base de datos, intente de nuevo!"
                ], 200);
            }
        }
    }

    public function validacionNombre($nombre)
    {
        return Producto::where('nombre', $nombre)
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