<?php

namespace App\Domain\UseCases\ProcesaData;


class SetArrayInstruments{

    public array $instruments;

    public function __construct(array $data) {
        //  echo "GetInstrumentoActividad __construct: <pre>".print_r($data, 1)."</pre>";  
          $this->instruments = $data ?? [];
    }


}