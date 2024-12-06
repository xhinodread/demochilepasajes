<?php
namespace App\Domain\Entities;

class NasaData {
    public string $id;
    public string $instruments;
    public string $activityID;
    public string $idActividad;

    public function __construct(array $data) {
        $this->id = $data['mpcID'] ?? '';
        $this->instruments = $data['instrument'] ?? '';
        $this->activityID = $data['activityID'] ?? '';
        $this->idActividad = $data['idActividad'] ?? '';
    }
}
?>