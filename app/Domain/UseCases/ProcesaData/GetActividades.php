<?php

namespace App\Domain\UseCases\ProcesaData;

class GetActividades{

    public array $instruments;

    public function __construct(array $data) {
          $this->instruments = $data ?? [];
    }

    public function procesa_instruments(): array {
        $objDatos=[];

        foreach($this->instruments as $indiceDatos){
            $objDatos[] = $indiceDatos->idActividad;

        }
        return $objDatos;
    }


}