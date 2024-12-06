<?php

namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataWSAE;


class NasaDataWSAEProcs{

    public string $id;
    public array $instruments;
    public string $activityID;

    public function __construct(array $data) {
    // echo "NasaDataRbeProcs __construct: <pre>".print_r($data, 1)."</pre>";  
        $this->id = $data['simulationID'] ?? '';
        $this->instruments = $data['cmeInputs'][0]['ipsList'][0]['instruments'] ?? [];
       // $this->activityID = $data['linkedEvents']?? [];
        $this->activityID = $data['cmeInputs'][0]['ipsList'][0]['activityID'] ?? '';
    }

    public function procesa_instruments(): array {
        $objDatos=[];
        //echo "instrumentrs <pre>".print_r($this->instruments, 1)."</pre>";

        foreach($this->instruments as $indiceDatos){
           //echo "instrum <pre>".print_r($indiceDatos, 1)."</pre>";
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
