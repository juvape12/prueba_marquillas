<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsables\productos\ProductoStore;
use App\Http\Responsables\productos\ProductoUpdate;
use App\Http\Responsables\productos\ProductoShow;
use App\Http\Responsables\productos\ProductoDelete;
use App\Traits\ApiResponser;

class ProductoController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $productos = new ProductoShow();
       return $productos->findAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->json();

        if(is_object($datos) && !empty($datos) && !is_null($datos) && count($datos) > 0)
        {
            return new ProductoStore();

        } else {
            return $this->errorResponse(['respuesta' => 'Datos Invalidos o Vacios'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $datos = $request;

        if(is_object($datos) && !empty($datos) && !is_null($datos))
        {
            $producto = new ProductoShow();
            return $producto->findById($datos->id_producto);

        } else {
            return $this->errorResponse(['respuesta' => 'Datos Invalidos o Vacios'], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datos = $request->json();

        if(is_object($datos) && !empty($datos) && !is_null($datos) && count($datos) > 0)
        {
            return new ProductoUpdate();

        } else {
            return $this->errorResponse(['respuesta' => 'Datos Invalidos o Vacios'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        $datos = $request;

        if(is_object($datos) && !empty($datos) && !is_null($datos))
        {
            return new ProductoDelete();

        } else {
            return $this->errorResponse(['respuesta' => 'Datos Invalidos o Vacios'], 400);
        }
    }
}
