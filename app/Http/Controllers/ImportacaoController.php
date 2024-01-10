<?php

namespace App\Http\Controllers;

use App\Models\Importacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImportacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try{   

            $data = Importacao::all();

            // Tratamentos

            foreach ($data as $key => $value) {

                $value['tempo'] = Carbon::createFromDate($value->created_at)->diff(Carbon::now())->format('%i') . ' minutos atrás';

                $value['path'] = str_replace('public', '/storage', $value->path);

                $data[$key] = $value;

            }

            return response()->json([
                "success"=> true,
                "data" => $data
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "success"=> false,
                "message"=> "Erro: ". $th->getMessage()
            ]);
            
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $path = Storage::put(
                'public/imports', $request->file('input-csv')
            );
            
            Importacao::create([
                'tabela' => 'pacientes',
                'path' => $path
            ]);

            return response()->json([
                "success"=> true,
                "message"=> "Cadastrado com sucesso!"
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "success"=> false,
                "message"=> $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
