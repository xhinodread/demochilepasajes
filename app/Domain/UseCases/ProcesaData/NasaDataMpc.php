<?php
namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaData;

class NasaDataMpc {
    public string $id;
   // public string $eventTime;
    public array $instruments;
    public array $activityID;



    // ... otros atributos según la respuesta de la API de la NASA
    
    public function __construct(array $data) {
        //echo "__construct: <pre>".print_r($data, 1)."</pre>";

        // Mapear los datos de la API a las propiedades de la entidad
        $this->id = $data['mpcID'] ?? '';
      //  $this->eventTime = $data['eventTime'] ?? '';
        $this->instruments = $data['instruments']?? '';
        $this->activityID = $data['linkedEvents']?? [];
        // ... mapear el resto de los atributos ................
    }

    public function procesa_instruments(): array {
        //echo "procesa_instruments.<br>";

        $objDatos = [];
        $x=0;
        foreach($this->activityID as $indice){
            foreach($this->instruments as $indiceInstrum){
               // echo $this->id.", ".print_r($indice, 1).", ".print_r($indiceInstrum, 1)."...........<br>";
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
        /***/
        foreach($objDatos as $indiceDatos){
         //////   echo "---> <pre>".print_r($indiceDatos,1)."</pre> <---- <br>";
          //  echo " >total indiceDatos:_ <pre>".count($indiceDatos['linkedEvents'])."</pre> < ";
            $nasaData[] = new NasaData($indiceDatos);
        }
       
        //echo "*****>nasaData:_ <pre>".print_r($nasaData,1)."</pre> <*****";
        return $nasaData;
    }

}
?>