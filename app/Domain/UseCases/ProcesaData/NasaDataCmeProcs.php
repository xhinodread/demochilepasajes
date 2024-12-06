<?php
namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataCme;


class NasaDataCmeProcs {
    public string $id;
    public array $instruments;
    public array $activityID;
    public string $idActividad;

        
    public function __construct(array $data) {
        
        $this->id = $data['activityID'] ?? '';
        $this->activityID = $data['linkedEvents'] ?? [];
        $this->instruments = $data['instruments']?? [];
        $this->idActividad = substr($data['activityID'], 20)?? '';
    }

    
    public function procesa_instruments(): array {
        
        $objDatos=[];
        foreach($this->instruments as $indiceDatos){
            $objDatos[] = new NasaDataCme(
                ['id'=> $this->id, 
                'instruments'=> $indiceDatos['displayName'],
                'activityID'=> $this->id, 
                'idActividad'=> $this->idActividad]
            );


        }
        return $objDatos;
    }


}
