<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukIkanController;
use App\Http\Controllers\Api\ProdukAquariumController;
/* use App\Models\ProdukIkan; */

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/produk-ikan', ProdukIkanController::class);
Route::apiResource('/produk-aquarium', ProdukAquariumController::class);

