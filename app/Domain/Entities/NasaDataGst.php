<?php
namespace App\Domain\Entities;


class NasaDataGst{

    public string $id;
    public string $instruments;
    public string $activityID;
    public string $idActividad;

    public function __construct(array $data) {
        // Mapear los datos de la API a las propiedades de la entidad
        $this->id = $data['id'] ?? '';
       // $this->eventTime = $data['eventTime'] ?? '';
       // $this->instruments = $data['instruments'][0]['displayName'] ?? '';
      //  $this->activityID = $data['linkedEvents'][0]['activityID'] ?? '';
        $this->instruments = $data['instruments'] ?? '';
        $this->activityID = $data['activityID'] ?? '';
        $this->idActividad = $data['idActividad'] ?? '';
        // ... mapear el resto de los atributos ................
    }


}