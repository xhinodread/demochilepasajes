<?php

namespace App\Domain\UseCases\ProcesaData;


class GetUsoInstrumentos{

    public array $instruments;
    public array $listaApariciones;
    public array $listaAparicionesFinal;

    public function __construct(array $data) {
        //  echo "GetUsoInstrumentos __construct: <pre>".print_r($data, 1)."</pre>";  
          $this->instruments = $data ?? [];
    }

    public function get_instrumentos(array $dataApariciones): array {
       // echo "get instrumentos: <pre>".print_r($this->instruments, 1)."</pre>";  
       // echo "get_instrumentos: <pre>".print_r($dataApariciones, 1)."</pre>";  

        $objDatos=[];

        foreach ($this->instruments as $key => $value) {
            $this->listaApariciones[$value] = 0;
        }
       // echo "listaApariciones: <pre>".print_r($this->listaApariciones, 1)."</pre>";

        foreach($dataApariciones as $indiceDatos){
            //echo  print_r($indiceDatos, 1)."<br>";
            //echo  print_r($indiceDatos->instruments, 1)." ".in_array($indiceDatos->instruments, $this->instruments)."<br>";

            if( in_array($indiceDatos->instruments, $this->instruments) ){
                $this->listaApariciones[$indiceDatos->instruments] += 1;
            }
        }

        $totalApariciones = count($dataApariciones);
       // echo "listaApariciones final: <pre>".print_r($this->listaApariciones, 1)."</pre>";
        $sumaPorcentajes = 0;
        $calcPorc = 0;
        foreach ($this->listaApariciones as $key => $value) {
            //$calcPorc = round($value/$totalApariciones, 3, PHP_ROUND_HALF_UP);
            //$calcPorc = ceil($value/$totalApariciones);            
            $calcPorc = ($value/$totalApariciones);

            //echo $key."... ".$value.":  ".$calcPorc." <-- <br>";
            $sumaPorcentajes += $calcPorc;
            $this->listaAparicionesFinal[$key] = number_format($calcPorc, 5);
        }
        //echo "total apariciones: ".$totalApariciones."<br>";
        //echo "<br>totalPorcentaje: ".($sumaPorcentajes)."<br>";
        //echo "<br>totalPorcentaje: <pre>".print_r($this->listaAparicionesFinal, 1)."</pre>";


        return $this->listaAparicionesFinal;
    }


}



