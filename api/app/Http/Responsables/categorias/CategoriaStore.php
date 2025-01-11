<?php

namespace App\Http\Responsables\categorias;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class CategoriaStore implements Responsable
{
    use ApiResponser;

    public function toResponse($request)
    {
        DB::connection('mysql')->beginTransaction();
        $datosRegistro = $request->all();

        $nombre = trim($datosRegistro['nombre_cat']);

        if((isset($nombre) && empty($nombre) || is_null($nombre)))
        {
            return $this->errorResponse([
                'message' => 
                        "El nombre de la categoría es obligatorio, verifique e intente de nuevo."
            ], 400);

        } else
        {
            try {

                $verificacionCategoria = $this->validacionCategoria(strtoupper($nombre));

                if($verificacionCategoria == 0)
                {
                    $categoria = Categoria::create([
                        'nombre' => strtoupper($nombre),
                        'estado' => 1,
                    ]);
                    
                    if($categoria)
                    {
                        DB::connection('mysql')->commit();
                        return $this->successResponse([
                            'message' => 
                                    "Categoria Registrada Correctamente!"
                        ], 200);
    
                    } else {
                        DB::connection('mysql')->rollback();
                        return $this->successResponse([
                            'message' => 
                                    "Ha ocurrido un error registrando la categoria,intente de nuevo, si el problema persiste contacte a Soporte!"
                        ], 200);                    
                    }
                } else {
                    DB::connection('mysql')->rollback();
                    return $this->successResponse([
                        'message' => 
                                "Ya existe una categoria con el mismo nombre ingresado!"
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

    public function validacionCategoria($nombre)
    {
        return Categoria::where('nombre', $nombre)
                ->get()
                ->count();
    }
}