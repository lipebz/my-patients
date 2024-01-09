<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CNSValidator extends Controller
{

    public function validateCns($value)
    {
        $cns = $this->sanitize($value);

        // CNSs definitivos começam em 1 ou 2 / CNSs provisórios em 7, 8 ou 9
        if (preg_match("/[1-2][0-9]{10}00[0-1][0-9]/", $cns) || preg_match("/[7-9][0-9]{14}/", $cns)) {

            return response()->json([
                'isValid' => $this->somaAcumulada($cns) % 11 == 0
            ]);
        }

        return response()->json([
            'isValid' => false
        ]);
    }

    private function somaAcumulada($value): int
    {
        $soma = 0;

        for ($i = 0; $i < mb_strlen($value); $i++) {
            $soma += $value[$i] * (15 - $i);
        }

        return $soma;
    }

    public function sanitize($value): string
    {
        return empty($value) ? "" : preg_replace('/[^\d]/', '', $value);
    }
}
