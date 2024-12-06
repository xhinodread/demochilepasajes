<?php
namespace App\Domain\Entities;

class NasaDataFlr{

    public string $id;
    public string $instruments;
    public string $activityID;
    public string $idActividad;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? '';
        $this->instruments = $data['instruments'] ?? '';
        $this->activityID = $data['activityID'] ?? '';
        $this->idActividad = $data['idActividad'] ?? '';
        // ... mapear el resto de los atributos ................
    }

}