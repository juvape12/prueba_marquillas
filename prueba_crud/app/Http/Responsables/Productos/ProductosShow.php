<?php

namespace App\Http\Responsables\Productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Traits\ConvertString;

class ProductosShow implements Responsable
{
    use ConvertString;
    public function toResponse($request)
    {}

    public function findAll()
    {
        $client = new Client([
            'base_uri' => "http://localhost:8001/api/app/producto_consultar",
            'headers' => [
                'Content-Type' => 'application/json,charset=utf-8'
            ],
            'body' => ''
        ]);

        $response = $client->request('GET');
        $res = $response->getBody()->getContents();
        $respuesta = json_decode($res, true);

        return $respuesta['Data']['message'];
    }

    public function findById($id)
    {
        $client = new Client([
            'base_uri' => "http://localhost:8001/api/app/producto_consultar_id",
            'headers' => [
                'Content-Type' => 'application/json,charset=utf-8'
            ],
            'body' => json_encode(["id_producto" => $id])
        ]);

        $response = $client->request('GET');
        $res = $response->getBody()->getContents();
        $respuesta = json_decode($res, true);

        return $respuesta['Data']['message'];
    }
}
