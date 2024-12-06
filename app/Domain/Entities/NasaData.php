<?php
namespace App\Domain\Entities;

class NasaData {
    public string $id;
    //public string $eventTime;
    public string $instruments;
    public string $activityID;
    public string $idActividad;



    // ... otros atributos según la respuesta de la API de la NASA
    
    public function __construct(array $data) {
        // Mapear los datos de la API a las propiedades de la entidad
        $this->id = $data['mpcID'] ?? '';
       // $this->eventTime = $data['eventTime'] ?? '';
       // $this->instruments = $data['instruments'][0]['displayName'] ?? '';
      //  $this->activityID = $data['linkedEvents'][0]['activityID'] ?? '';
        $this->instruments = $data['instrument'] ?? '';
        $this->activityID = $data['activityID'] ?? '';
        $this->idActividad = $data['idActividad'] ?? '';
        // ... mapear el resto de los atributos ................
    }
}
?>