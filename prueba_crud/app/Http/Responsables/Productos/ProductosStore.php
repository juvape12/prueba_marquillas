<?php

namespace App\Http\Responsables\Productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Traits\ConvertString;

class ProductosStore implements Responsable
{
    use ConvertString;
    public function toResponse($request)
    {
        $codigoProducto = request('codigo', null);
        $nombreProducto = request('nombre', null);
        $categoriaId = request('categoria', null);
        $precioProducto = request('precio', null);

        $client = new Client([
            'base_uri' => "http://localhost:8001/api/app/producto_store",
            'headers' => [
                'Content-Type' => 'application/json,charset=utf-8'
            ],
            'body' => json_encode([
                "codigo" => $codigoProducto,
                "nombre" => $this->eliminar_tildes($nombreProducto),
                "categoria_id" => $categoriaId,
                "precio" => $precioProducto
            ])
        ]);

        $response = $client->request('POST');
        $res = $response->getBody()->getContents();
        $respuesta = json_decode($res, true);
        
        return redirect()->back()->with('success', $respuesta['Data']['message']); 
    }
}
