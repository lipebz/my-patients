<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class ApiCepService extends Controller
{

    public function search(string $cep)
    {

        $cep = preg_replace( '/[^0-9]/', '', $cep);

        $data = Redis::get("cep_{$cep}");

        if (!$data) {
            
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json");
    
            $data = $response->json();

            if (empty($data) || $data['erro']) {
                return response()->json([
                    "success" => false,
                    "message"=> 'Não foi possível localizar este CEP',
                ]);
            }

            Redis::set("cep_{$cep}", json_encode($data));
            
        }

        $data = json_decode($data, true);       

        return response()->json([
            "success" => true,
            "data"=> $data,
        ]);
    }

}
