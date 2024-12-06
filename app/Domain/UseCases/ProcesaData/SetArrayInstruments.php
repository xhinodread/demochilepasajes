<?php

namespace App\Domain\UseCases\ProcesaData;


class SetArrayInstruments{

    public array $instruments;

    public function __construct(array $data) {
          $this->instruments = $data ?? [];
    }


}