<?php
namespace App\Http\Controllers;

use App\Domain\UseCases\GetNasaData;
use Illuminate\Http\JsonResponse;

class NasaDataController extends Controller
{

    public function index(GetNasaData $getNasaData): JsonResponse {
       $data = $getNasaData->execute();
       return response()->json($data);
    }
}



?>