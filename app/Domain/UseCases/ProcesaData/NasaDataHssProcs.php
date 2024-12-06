<?php

namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataHss;


class NasaDataHssProcs{

    public string $id;
    public array $instruments;
    public array $activityID;

    public function __construct(array $data) {
          $this->id = $data['hssID'] ?? '';
          $this->instruments = $data['instruments'] ?? [];
          $this->activityID = $data['linkedEvents']?? [];
      }

    public function procesa_instruments(): array {
        $objDatos=[];

        foreach($this->instruments as $indiceDatos){
            foreach($this->activityID as $indiceActivityID){
                
                $objDatos[] = new NasaDataHss([
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
