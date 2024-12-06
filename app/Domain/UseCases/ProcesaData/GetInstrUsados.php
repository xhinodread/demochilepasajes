<?php

namespace App\Domain\UseCases\ProcesaData;

class GetInstrUsados{

    public array $instruments;

    public function __construct(array $data) {
          $this->instruments = $data ?? [];
    }

    public function procesa_instruments(): array {
        $objDatos=[];

        foreach($this->instruments as $indiceDatos){
            $objDatos[] = $indiceDatos->instruments;

        }
        return $objDatos;
    }


}

