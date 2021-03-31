<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('proximo-vencerse', 'ReporteApiController@getProximoVencerse');
Route::get('seguimiento', 'ReporteApiController@getSeguimientoMatrizPorFuncion');
Route::get('conductores-habilitados', 'ReporteApiController@getConductoresHabilitados');
Route::get('personal-well-control', 'ReporteApiController@getPersonalWellControl');
Route::get('get-evento/{id}', 'ReporteApiController@getEvento');
Route::get('get-evento-enviar/{id}', 'ReporteApiController@getEventoEnviar');
Route::get('historico-capacitacion', 'ReporteApiController@getHistoricoCapacitacion');
Route::get('programa-capacitacion/{gestion}', 'ReporteApiController@getProgramaCapacitacion');
Route::get('login/{email}/{password}', 'ReporteApiController@login');
