<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SecretaryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::controller(RegisterController::class)->group(function()
{
    Route::post('login', 'login');
    Route::post('logout', 'logout');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Secretary Method Admin
Route::middleware('auth:sanctum')->get('/index/secretaries',[AdminController::class ,'index']);
Route::middleware('auth:sanctum')->post('/add/secretary',[AdminController::class ,'addSecretary']);
Route::middleware('auth:sanctum')->get('/editsecretary/{secretaryId}',[AdminController::class ,'editSecretary']);
Route::middleware('auth:sanctum')->put('/updatesecretary/{secretaryId}',[AdminController::class ,'updateSecretary']);
Route::middleware('auth:sanctum')->delete('/deletesecretary/{secretaryId}',[AdminController::class ,'deleteSecretary']);
Route::middleware('auth:sanctum')->post('/todayattente/{secretaryId}',[AdminController::class ,'getToday']);


//Add Rapport Admin
Route::middleware('auth:sanctum')->post('/addmanualreport',[AdminController::class ,'addManualReport']);
Route::middleware('auth:sanctum')->get('/edit/rapport/{rapportId}',[AdminController::class ,'editRapport']);
Route::middleware('auth:sanctum')->put('/update/rapport/{rapportId}',[AdminController::class ,'updateRapport']);
Route::middleware('auth:sanctum')->delete('/delete/rapport/{rapportId}',[AdminController::class ,'deleteRapport']);
Route::middleware('auth:sanctum')->get('/client/info/{clientId}',[AdminController::class ,'clientInfo']);




Route::middleware('auth:sanctum')->get('/all/rapports',[AdminController::class ,'getRapport']);
Route::middleware('auth:sanctum')->post('/printreport/{reportId}',[AdminController::class ,'printReport']);

//Gere Patient for admin
Route::middleware('auth:sanctum')->get('/index/patient',[ClientController::class ,'index']);
Route::middleware('auth:sanctum')->post('/create/patient',[ClientController::class ,'createClient']);
Route::middleware('auth:sanctum')->get('/edit/{patientId}',[ClientController::class ,'editClient']);
Route::middleware('auth:sanctum')->get('/clients/search',[ClientController::class ,'searchByCIN']);


Route::middleware('auth:sanctum')->put('/update/{patientId}',[ClientController::class ,'updateClient']);
Route::middleware('auth:sanctum')->delete('/delete/patient/{patientId}',[ClientController::class ,'softDelete']);
Route::middleware('auth:sanctum')->post('/upload/document/{patientId}',[ClientController::class ,'uploadDocument']);

//Gere rendez-vous
Route::middleware('auth:sanctum')->get('/index/rendez-vous',[SecretaryController::class ,'index']);
Route::middleware('auth:sanctum')->get('/all/rendez-vous',[SecretaryController::class ,'getRendezVous']);

Route::middleware('auth:sanctum')->post('/addrendez-vous',[SecretaryController::class ,'addRendezVous']);
Route::middleware('auth:sanctum')->get('/edit/rendez-vous/{rendezId}',[SecretaryController::class ,'editRendezVous']);
Route::middleware('auth:sanctum')->put('/update/rendez-vous/{rendezId}',[SecretaryController::class ,'updateRendezVous']);
Route::middleware('auth:sanctum')->delete('/cancel/rendez-vous/{rendezId}',[SecretaryController::class ,'softDelete']);

//Gere Salle-attente
Route::middleware('auth:sanctum')->get('/all/salle-attente',[SecretaryController::class ,'getSalleAttente']);
Route::middleware('auth:sanctum')->post('/add/salle-attente',[SecretaryController::class ,'addToWaitingRoom']);
Route::middleware('auth:sanctum')->get('/edit/salle-attente/{salleId}',[SecretaryController::class ,'editSalleAttente']);
Route::middleware('auth:sanctum')->put('/update/salle-attente/{salleId}',[SecretaryController::class ,'updateWaitingRoomEntry']);
Route::middleware('auth:sanctum')->delete('/delete/salle-attente/{salleId}',[SecretaryController::class ,'removeWaitingRoomEntry']);

Route::middleware('auth:sanctum')->post('/add/payment',[PaymentController::class ,'create']);
Route::middleware('auth:sanctum')->get('/all/payment',[PaymentController::class ,'index']);
Route::middleware('auth:sanctum')->get('/edit/payment/{paymentId}',[PaymentController::class ,'edit']);
Route::middleware('auth:sanctum')->put('/update/payment/{paymentId}',[PaymentController::class ,'update']);
Route::middleware('auth:sanctum')->delete('/delete/payment/{paymentId}',[PaymentController::class ,'deletePayment']);


