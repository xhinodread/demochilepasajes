<?php

namespace App\Domain\UseCases\ProcesaData;

//use App\Domain\Entities\NasaDataHss;

class GetActividades{

    public array $instruments;

    public function __construct(array $data) {
          //echo "GetActividades __construct: <pre>".print_r($data, 1)."</pre>";  
          $this->instruments = $data ?? [];
    }

    public function procesa_instruments(): array {
        $objDatos=[];

        foreach($this->instruments as $indiceDatos){
            // echo  print_r($indiceDatos->instruments, 1)."<br>";
            $objDatos[] = $indiceDatos->idActividad;

        }
        return $objDatos;
    }


}