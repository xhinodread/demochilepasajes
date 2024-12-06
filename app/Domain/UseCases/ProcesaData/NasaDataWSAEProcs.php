<?php

namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataWSAE;


class NasaDataWSAEProcs{

    public string $id;
    public array $instruments;
    public string $activityID;

    public function __construct(array $data) {
        $this->id = $data['simulationID'] ?? '';
        $this->instruments = $data['cmeInputs'][0]['ipsList'][0]['instruments'] ?? [];
        $this->activityID = $data['cmeInputs'][0]['ipsList'][0]['activityID'] ?? '';
    }

    public function procesa_instruments(): array {
        $objDatos=[];

        foreach($this->instruments as $indiceDatos){
            $objDatos[] = new NasaDataWSAE([
                'id'=> $this->id, 
                'instruments'=> $indiceDatos['displayName'],
                'activityID'=> $this->activityID, 
                'idActividad'=> substr($this->activityID, 20) ,
            ]);
      
        }
        return $objDatos;
    }

}
