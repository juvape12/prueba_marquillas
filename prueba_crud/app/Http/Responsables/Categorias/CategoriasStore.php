<?php

namespace App\Http\Responsables\Categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Traits\ConvertString;

class CategoriasStore implements Responsable
{
    use ConvertString;
    public function toResponse($request)
    {
        $nombreCategoria = request('nombre_cat', null);

        $client = new Client([
            'base_uri' => "http://localhost:8001/api/app/categoria_store",
            'headers' => [
                'Content-Type' => 'application/json,charset=utf-8'
            ],
            'body' => json_encode(["nombre_cat" => $this->eliminar_tildes($nombreCategoria)])
        ]);

        $response = $client->request('POST');
        $res = $response->getBody()->getContents();
        $respuesta = json_decode($res, true);
        
        return redirect()->back()->with('success', $respuesta['Data']['message']);   
    }
}
