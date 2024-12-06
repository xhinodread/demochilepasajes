<?php

namespace App\Domain\Repositories;

use App\Domain\Repositories\NasaDataRepositoryInterface;
use GuzzleHttp\Client;
use Exception;

class NasaDataRepository implements NasaDataRepositoryInterface {
    private string $apiKey;

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getNasaData(
                                string $rutaUrl = '',
                                array $query = []
                               ): array {
        $client = new Client(['base_uri' => 'https://api.nasa.gov']);
        try {
            $response = $client->request('GET', $rutaUrl, $query);
            $data = json_decode($response->getBody(), true);            
            return $data;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}

?>