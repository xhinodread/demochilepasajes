<?php
namespace App\Domain\UseCases\ProcesaData;

use App\Domain\Entities\NasaDataGst;


class NasaDataGstProcs{

    public string $id;
    public string $instruments;
    public array $activityID;
    public array $idActividad;

    public function __construct(array $data) {
       // echo "NasaDataGstProcs __construct: <pre>".print_r($data, 1)."</pre>";

        $this->id = $data['gstID'] ?? '';
        $this->instruments = $data['allKpIndex'][0]['source'] ?? '';
        $this->activityID = $data['linkedEvents']?? [];

    }

    public function procesa_instruments(): array {
        
       
        // echo "CME procesa_instruments";
        // echo "instruments: <pre>". $this->id .print_r($this->instruments, 1)."</pre>";
         //echo "activityID: <pre>". $this->id."<br>" .print_r($this->activityID, 1)."</pre>";
         $objDatos=[];
     /*****/
       // echo "<br> cunt objDatos: ".count($this->activityID)."<br>";
        foreach($this->activityID as $indiceDatos){
            /*** * / 
             echo "XXXX <pre>". $this->id.", " 
            //.count($indiceDatos['activityID']).", "
            .print_r($indiceDatos['activityID'], 1).", "
            .print_r($this->instruments, 1).", "
            .print_r(substr($indiceDatos['activityID'], 20), 1)."</pre>";
            / ***/
            //echo $echo;
            $objDatos[] = [
                'id'=> $this->id, 
                'instruments'=> $this->instruments,
                'activityID'=> $indiceDatos['activityID'], 
                'idActividad'=> substr($indiceDatos['activityID'], 20) ,
            ];
            /*****/    
         }
     /*****/

        $nasaData=[];
        foreach($objDatos as $indiceDatos){
         //////   echo "---> <pre>".print_r($indiceDatos,1)."</pre> <---- <br>";
          //  echo " >total indiceDatos:_ <pre>".count($indiceDatos['linkedEvents'])."</pre> < ";
            $nasaData[] = new NasaDataGst($indiceDatos);
        }

       // echo "objDatos: ".print_r($nasaData,1);
        // echo "<br> cunt objDatos: ".count($objDatos)."<br>";
         return $nasaData;
      
     }
}



