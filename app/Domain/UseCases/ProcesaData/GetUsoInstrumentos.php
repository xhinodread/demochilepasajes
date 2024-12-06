<?php

namespace App\Domain\UseCases\ProcesaData;


class GetUsoInstrumentos{

    public array $instruments;
    public array $listaApariciones;
    public array $listaAparicionesFinal;

    public function __construct(array $data) {
          $this->instruments = $data ?? [];
    }

    public function get_instrumentos(array $dataApariciones): array {

        $objDatos=[];

        foreach ($this->instruments as $key => $value) {
            $this->listaApariciones[$value] = 0;
        }

        foreach($dataApariciones as $indiceDatos){
              if( in_array($indiceDatos->instruments, $this->instruments) ){
                $this->listaApariciones[$indiceDatos->instruments] += 1;
            }
        }

        $totalApariciones = count($dataApariciones);
        $sumaPorcentajes = 0;
        $calcPorc = 0;
        foreach ($this->listaApariciones as $key => $value) {        
            $calcPorc = ($value/$totalApariciones);
            $sumaPorcentajes += $calcPorc;
            $this->listaAparicionesFinal[$key] = number_format($calcPorc, 5);
        }
        
        return $this->listaAparicionesFinal;
    }


}



