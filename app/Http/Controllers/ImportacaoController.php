<?php

namespace App\Http\Controllers;

use App\Jobs\ImportCsvJob;
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

            $data = Importacao::orderBy('id', 'desc')->get();

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

            $filename = uniqid() .'.'. $request->file('input-csv')->getClientOriginalExtension();

            $path = Storage::putFileAs(
                'public/imports', $request->file('input-csv'), $filename
            );
            
            $importacao = Importacao::create([
                'tabela' => 'pacientes',
                'path' => $path
            ]);
        

            ImportCsvJob::dispatch($importacao)
                    ->delay(Carbon::now()->addSeconds(10));

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

    public function importarCsv($importacao)
    {

        $data = $this->csvToArray($importacao->path, ';'); 

        $importacao->update([
            'quantidade' => count($data),
            'data' => json_encode($data),
            'status' => 'Aguardando validação',
            'proccess_at' => date('Y-m-d H:i:s')
        ]);

    }

    private function csvToArray($filename = '', $delimiter = ';', $limit = null) {

        $filename = storage_path('app/' . $filename);

        if (!file_exists($filename) || !is_readable($filename))
            return false;

    
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header) {
                    foreach ($row as $rr => $rro) {
                        $row[$rr] = strtolower($rro);
                    }
                    $header = $row;
                }
                else {
                    foreach ($row as $rr => $rro) {
                        $row[$rr] = strtoupper($rro);
                    }
    
                    if ($limit === null)
                        $data[] = array_combine($header, $row);
    
                    else {
                        if (count($data) < $limit) {
                            $data[] = array_combine($header, $row);
                        }
                        else {
                            break;
                        }
    
                    }
                    
                }
            }
            fclose($handle);
        }
    
        return $data;
    }

}
