<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//********************************   Vehicule*********************************** */
//Afficher par id
Route::post('/vehicles/show-vehicle',[VehiculeController::class,'show']);
//Afficher le tous
Route::get('/vehicles/all-vehicle',[VehiculeController::class,'allData']);
//Supprimer 
Route::post('/vehicles/destory-vehicle',[VehiculeController::class,'destroy']);
//Modifier par id
Route::post('/vehicles/edit-vehicle',[VehiculeController::class,'edit']);
//Ajouter les Vehicule
Route::post('/vehicles/store-vehicle',[VehiculeController::class,'store']);
//Gestion des appels
Route::post('/vehicles/check-vidange', [VehiculeController::class, 'checkVidange']);
Route::post('/vehicles/check-visite-teck', [VehiculeController::class, 'checkVisiteTech']);
Route::post('/vehicles/check-assurance', [VehiculeController::class, 'checkAssurance']);

Route::post('/vehicles/show-vehicles-list', [VehiculeController::class, 'showVehiclesList']);
//******************************** Entre Service *********************************** */
Route::post('/vehicles/get-vehicles-by-category', [VehiculeController::class, 'getVehiclesByCategory']);

Route::get('/vehicles/show-vehicle-by-id/{id}',[VehiculeController::class,'showById']);