<?php
namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataCme;


class NasaDataCmeProcs {
    public string $id;
    //public string $eventTime;
    public array $instruments;
    public array $activityID;
    public string $idActividad;

        
    public function __construct(array $data) {
      //  echo "__construct: <pre>".print_r($data, 1)."</pre>";
        // Mapear los datos de la API a las propiedades de la entidad
        $this->id = $data['activityID'] ?? '';
       // if(is_countable($data['linkedEvents'])){ 
            $this->activityID = $data['linkedEvents'] ?? [];
       // }else{
       //     $this->activityID = [];
       // }
        $this->instruments = $data['instruments']?? [];
        $this->idActividad = substr($data['activityID'], 20)?? '';
        // ... mapear el resto de los atributos ................
    }

    
    public function procesa_instruments(): array {
       // echo "CME procesa_instruments";
       // echo "instruments: <pre>". $this->id .print_r($this->instruments, 1)."</pre>";
       // echo "activityID: <pre>". $this->id .print_r($this->activityID, 1)."</pre>";
        $objDatos=[];
    /***/
        foreach($this->instruments as $indiceDatos){
            $objDatos[] = new NasaDataCme(
                ['id'=> $this->id, 
                'instruments'=> $indiceDatos['displayName'],
                'activityID'=> $this->id, 
                'idActividad'=> $this->idActividad]
            );


        }
    /*****/
        return $objDatos;
    }


}
