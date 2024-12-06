<?php

namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataFlr;


class NasaDataFlrProcs{

    public string $id;
    public array $instruments;
    public array $activityID;

    public function __construct(array $data) {
 
         $this->id = $data['flrID'] ?? '';
         $this->instruments = $data['instruments'] ?? [];
         $this->activityID = $data['linkedEvents']?? [];
 
     }

     public function procesa_instruments(): array {
        $objDatos=[];

        foreach($this->instruments as $indiceDatos){
            foreach($this->activityID as $indiceActivityID){

                $objDatos_[] = [
                    'id'=> $this->id, 
                    'instruments'=> $indiceDatos['displayName'],
                    'activityID'=> $indiceActivityID['activityID'], 
                    'idActividad'=> substr($indiceActivityID['activityID'], 20) ,
                ];

                $objDatos[] = new NasaDataFlr([
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

