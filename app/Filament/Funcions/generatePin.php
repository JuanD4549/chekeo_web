<?Php

namespace App\Filament\Funcions;

use App\Models\PreVisit;

class GeneratePin
{
    public function generate(): ?int
    {
        $numeros_generados = PreVisit::select('pin')->pluck('pin')->toArray();
        //$array=[];
        //dd($numeros_generados);
        $status=false;
        while ($status!=true) {
            //dd('entro');
            $numero = mt_rand(1000, 9999);
            //dd(in_array($numero, $array,true));
            if (!in_array($numero, $numeros_generados,true)) {
                //dd($numero);
                return $numero;
            }
        }
    }
}
