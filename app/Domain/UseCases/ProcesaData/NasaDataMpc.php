<?php
namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaData;

class NasaDataMpc {
    public string $id;
    public array $instruments;
    public array $activityID;
    
    public function __construct(array $data) {
        $this->id = $data['mpcID'] ?? '';
        $this->instruments = $data['instruments']?? '';
        $this->activityID = $data['linkedEvents']?? [];
    }

    public function procesa_instruments(): array {

        $objDatos = [];
        $x=0;
        foreach($this->activityID as $indice){
            foreach($this->instruments as $indiceInstrum){
                $objDatos[] = [
                    'mpcID'=>$this->id, 
                    'activityID'=>$indice['activityID'], 
                    'instrument'=>$indiceInstrum['displayName'],
                    'idActividad'=>substr($indice['activityID'],20) ,
                ];
                $x++;
            }
        }

        $nasaData=[];
        foreach($objDatos as $indiceDatos){
            $nasaData[] = new NasaData($indiceDatos);
        }
       
        return $nasaData;
    }

}
?>