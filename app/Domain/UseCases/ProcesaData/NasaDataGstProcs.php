<?php
namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataGst;


class NasaDataGstProcs{

    public string $id;
    public string $instruments;
    public array $activityID;
    public array $idActividad;

    public function __construct(array $data) {

        $this->id = $data['gstID'] ?? '';
        $this->instruments = $data['allKpIndex'][0]['source'] ?? '';
        $this->activityID = $data['linkedEvents']?? [];

    }

    public function procesa_instruments(): array {
        $objDatos=[];
        foreach($this->activityID as $indiceDatos){
            $objDatos[] = [
                'id'=> $this->id, 
                'instruments'=> $this->instruments,
                'activityID'=> $indiceDatos['activityID'], 
                'idActividad'=> substr($indiceDatos['activityID'], 20) ,
            ];
         }

        $nasaData=[];
        foreach($objDatos as $indiceDatos){
            $nasaData[] = new NasaDataGst($indiceDatos);
        }

        return $nasaData;
      
     }
}



