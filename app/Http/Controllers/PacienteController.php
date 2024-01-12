<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->query('search');

        $search = str_replace('+', '%', $search);

        try {

            $pacientes = Paciente::with('endereco')
                            ->where('nome', 'ilike', "%$search%")
                            ->orderBy('nome')
                            ->paginate(5);

            // Tratamentos

            foreach ($pacientes as $key => $paciente) {

                $paciente['idade'] = Carbon::createFromDate($paciente->data_nascimento)->diff(Carbon::now())->format('%y');

                $paciente['cpf_formatado'] = $this->mask($paciente->cpf, '###.###.###-##');

                $paciente['cns_formatado'] = $this->mask($paciente->cns, '### #### #### ####');


                $paciente['foto_url'] = $this->getFoto($paciente['foto_url']);


                $pacientes[$key] = $paciente;

            }

    
            return response()->json([
                "success"=> true,
                "data" => $pacientes
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "success"=> false,
                "message"=> "Erro: ". $th->getMessage()
            ]);
            
        }

    }

    private function getFoto($foto_url)
    {

        if (empty($foto_url))
            $foto_url = '/storage/sem-foto.png';

        else if (str_starts_with($foto_url, 'public'))
            $foto_url = str_replace('public', '/storage', $foto_url);

        return $foto_url;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (empty($request->file('input-foto')))
            return response()->json([
                "success"=> false,
                "message"=> 'É necessário anexar a foto'
            ]);


        $request['cep'] = preg_replace( '/[^0-9]/', '', $request['cep']);
        $request['cpf'] = preg_replace( '/[^0-9]/', '', $request['cpf']);
        $request['cns'] = preg_replace( '/[^0-9]/', '', $request['cns']);
        $request['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $request['data_nascimento'])->format('Y-m-d');
        
        try {


            $path = Storage::put(
                'public/profiles', $request->file('input-foto')
            );

            $request->request->add(['foto_url' => $path]);

            $paciente = Paciente::create($request->all());

            $paciente->endereco()->create($request->all());


            return response()->json([
                "success"=> true,
                "message"=> "Cadastrado com sucesso!"
            ]);

        } catch (\Throwable $th) {

            $errorSQL = $th->getMessage();

            if (!empty($th->errorInfo) && $th->errorInfo[0] == 23505)
                $errorSQL = 'Já existe um cadastro com esse CPF/CNS';


            return response()->json([
                "success"=> false,
                "message"=> $errorSQL
            ]);
        }

        

    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {


        $paciente['idade'] = Carbon::createFromDate($paciente->data_nascimento)->diff(Carbon::now())->format('%y');

        $paciente['data_nascimento_formatada'] = date('d/m/Y', strtotime($paciente->data_nascimento));

        $paciente['cpf_formatado'] = $this->mask($paciente->cpf, '###.###.###-##');

        $paciente['cns_formatado'] = $this->mask($paciente->cns, '### #### #### ####');

        $paciente['endereco_formatado'] = $paciente->endereco->logradouro . ', ' . $paciente->endereco->numero . $paciente->endereco->complemento . ' - ' . $paciente->endereco->cidade . ', ' . $paciente->endereco->uf;

        $paciente['foto_url'] = $this->getFoto($paciente['foto_url']);





        return response()->json([
            "success"=> true,
            "data"=> $paciente
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
 
        $request['cep'] = preg_replace( '/[^0-9]/', '', $request['cep']);
        $request['cpf'] = preg_replace( '/[^0-9]/', '', $request['cpf']);
        $request['cns'] = preg_replace( '/[^0-9]/', '', $request['cns']);
        $request['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $request['data_nascimento'])->format('Y-m-d');
        
        try {

            if (!empty($request->file('input-foto'))) {

                $path = Storage::put(
                    'public/profiles', $request->file('input-foto')
                );

                $request->request->add(['foto_url' => $path]);

            }

            $paciente->update($request->except('_method'));

            $paciente->endereco()->update($request->only([
                'cep',
                'logradouro',
                'numero',
                'complemento',
                'bairro',
                'cidade',
                'uf'
            ]));


            return response()->json([
                "success"=> true,
                "message"=> "Atualziado com sucesso!"
            ]);

        } catch (\Throwable $th) {

            $errorSQL = $th->getMessage();

            if (!empty($th->errorInfo) && $th->errorInfo[0] == 23505)
                $errorSQL = 'Já existe um cadastro com esse CPF/CNS';


            return response()->json([
                "success"=> false,
                "message"=> $errorSQL
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
