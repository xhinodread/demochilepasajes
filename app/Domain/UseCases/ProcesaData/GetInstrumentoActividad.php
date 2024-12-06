<?php

namespace App\Domain\UseCases\ProcesaData;


class GetInstrumentoActividad{

    public array $instruments;
    public array $listaInstrumentsActividades;
    public array $listaAparicionesFinal;
    public array $instrumentoActividad;

    public function __construct(array $data) {
          $this->instruments = $data ?? [];
    }
    
    public function get_instrumentos(array $dataEventosActividades): array {
     
        foreach ($this->instruments as $key => $value) {
            $this->listaInstrumentsActividades[$value] = [];
        }

        foreach ($dataEventosActividades as $key => $value) {
          
            foreach ($this->listaInstrumentsActividades as $keyB => $valueB) {
                if(($value->instruments == $keyB)){
                    array_push($this->listaInstrumentsActividades[$keyB], $value->idActividad);
                }
            }
        }

        foreach ($this->listaInstrumentsActividades as $keyA => $valueA) {        
            $this->listaAparicionesFinal[$keyA] = array_count_values($valueA);            
        }

        $totKeyA = 0;
        foreach ($this->listaAparicionesFinal as $keyA => $valueA) {
            $totKeyA = array_sum($valueA);
            foreach ($valueA as $keyB => $valueB) {
                $this->instrumentoActividad[$keyA][$keyB] = $valueB/$totKeyA;
            }
        }

        return $this->instrumentoActividad;
    }

}