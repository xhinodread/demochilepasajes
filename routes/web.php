<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasaDataController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/nasaapitest', [NasaDataController::class, 'index']);


