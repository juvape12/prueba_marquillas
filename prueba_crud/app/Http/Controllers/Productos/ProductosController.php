<?php

namespace App\Http\Controllers\Productos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorias\Categoria;
use App\Http\Responsables\Productos\ProductosStore;
use App\Http\Responsables\Productos\ProductosUpdate;
use App\Http\Responsables\Productos\ProductosShow;
use App\Http\Responsables\Productos\ProductosDelete;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = new ProductosShow();
        $productos = $producto->findAll();
    
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::select('id', 'nombre')->pluck('nombre', 'id');
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new ProductosStore();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productoById = new ProductosShow();
        $producto = $productoById->findById($id);
        $categorias = Categoria::select('id', 'nombre')->pluck('nombre', 'id');

        view()->share('producto', $producto);
        view()->share('categorias', $categorias);
        return view('productos.edit');
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
        return new ProductosUpdate();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }

    public function eliminarProducto(Request $request)
    {
        return new ProductosDelete();
    }
}
