<?php

namespace App\Http\Responsables\Productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Traits\ConvertString;

class ProductosDelete implements Responsable
{
    use ConvertString;
    public function toResponse($request)
    {
        $idProducto = request('id_producto', null);

        $client = new Client([
            'base_uri' => "http://localhost:8001/api/app/producto_delete",
            'headers' => [
                'Content-Type' => 'application/json,charset=utf-8'
            ],
            'body' => json_encode([
                "id_producto" => $idProducto
            ])
        ]);

        $response = $client->request('DELETE');
        $res = $response->getBody()->getContents();
        $respuesta = json_decode($res, true);
        return $respuesta;
    }
}
