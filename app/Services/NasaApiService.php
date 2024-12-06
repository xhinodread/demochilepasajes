<?php

namespace App\Services;

class NasaApiService{

    public function getApiKey(): string{
        return config('services.nasa.api_key'); 
    }

}


?>