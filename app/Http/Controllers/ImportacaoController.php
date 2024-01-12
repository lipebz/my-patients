<?php

namespace App\Http\Controllers;

use App\Jobs\ImportCsvJob;
use App\Models\Importacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

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
        try{   

            $data = Importacao::find($id);

            // Tratamentos

            $data['data'] = json_decode($data['data']);


            $info = [];
            
            foreach ($data['data'] as $value) {

                $value->data_nascimento_formatada = date('d/m/Y', strtotime($value->data_nascimento));

                $value->cpf_formatado = $this->mask($value->cpf, '###.###.###-##');
                $value->cns_formatado = $this->mask($value->cns, '### #### #### ####');
                $value->cep_formatado = $this->mask($value->cep, '#####-###');


                $info[] = $value;

            }

            $data['data'] = $info;


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

    private function mask($val, $mask): string {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    public function importarCsv($importacao)
    {

        $data = $this->csvToArray($importacao->path, ';'); 

        foreach ($data as $key => $value) {

            $value['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $data['data_nascimento'])->format('Y-m-d');

            $data[$key] = $value;
        }

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
