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

                $paciente['cns_formatado'] = $this->mask($paciente->cns, '###.####.####-####');


                if (empty($paciente['foto_url']))
                    $paciente['foto_url'] = 'https://www.promoview.com.br/uploads/images/unnamed%2819%29.png';

                else if (str_starts_with($paciente['foto_url'], 'public'))
                    $paciente['foto_url'] = str_replace('public', '/storage', $paciente->foto_url);



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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
