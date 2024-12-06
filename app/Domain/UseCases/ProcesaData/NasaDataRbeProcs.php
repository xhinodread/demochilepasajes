<?php

namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataRbe;


class NasaDataRbeProcs{

    public string $id;
    public array $instruments;
    public array $activityID;

    public function __construct(array $data) {
  
          $this->id = $data['rbeID'] ?? '';
          $this->instruments = $data['instruments'] ?? [];
          $this->activityID = $data['linkedEvents']?? [];
  
      }

      public function procesa_instruments(): array {
        $objDatos=[];

        foreach($this->instruments as $indiceDatos){
            foreach($this->activityID as $indiceActivityID){
                $objDatos[] = new NasaDataRbe([
                    'id'=> $this->id, 
                    'instruments'=> $indiceDatos['displayName'],
                    'activityID'=> $indiceActivityID['activityID'], 
                    'idActividad'=> substr($indiceActivityID['activityID'], 20) ,
                ]);
              
            }
        }
        return $objDatos;
     }


}