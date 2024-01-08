<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

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

            $pacientes = Paciente::with('endereco')->where('nome', 'ilike', "%$search%")->paginate(5);

            // Tratamentos

            foreach ($pacientes as $key => $paciente) {

                $paciente['idade'] = Carbon::createFromDate($paciente->data_nascimento)->diff(Carbon::now())->format('%y');

                $paciente['cpf_formatado'] = $this->mask($paciente->cpf, '###.###.###-##');

                $paciente['cns_formatado'] = $this->mask($paciente->cns, '###.####.####-####');



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
        //
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
