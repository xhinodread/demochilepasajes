<?php

use App\Http\Controllers\NasaDataController;

Route::get('/mpc', [NasaDataController::class, 'index']);


?>