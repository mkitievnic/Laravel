<?php
//DB::listen(function ($query){
//    echo "<pre>{$query->sql}</pre>";
//});

use App\Patrones\Permisos;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("home");
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->middleware('verified');

    Route::resource('users', 'UserController', ['only' => ['edit', 'update']])->middleware(Permisos::nivelAvanzado());
    Route::put('users.update_password/{id}', ['as' => 'users.update_password', 'uses' => 'UserController@updatePassword'])->middleware(Permisos::nivelInicial());;

    Route::resource('empleados', 'EmpleadoController')->middleware(Permisos::nivelInicial());
    Route::resource('sectors', 'SectorController', ['except' => ['show']])->middleware(Permisos::nivelAvanzado());
    Route::resource('funcions', 'FuncionController')->middleware(Permisos::nivelAvanzado());
    Route::resource('instructors', 'InstructorController', ['except' => ['show']])->middleware(Permisos::nivelAvanzado());
    Route::resource('cursoFuncions', 'CursoFuncionController', ['only' => ['store', 'destroy']])->middleware(Permisos::nivelAvanzado());
    Route::post('asignarCurso/{curso_id}/{funcion_id}/{gestion}', 'CursoFuncionController@asignarCurso')->name('asignarCurso')->middleware(Permisos::nivelAvanzado());
    Route::resource('materials', 'MaterialController', ['only' => ['index', 'store', 'destroy']])->middleware(Permisos::nivelMedio());
    Route::resource('cursos', 'CursoController', ['except' => ['show']])->middleware(Permisos::nivelAvanzado());
    Route::resource('preguntas', 'PreguntaController', ['except' => ['show']])->middleware(Permisos::nivelMedio());
    Route::resource('opcions', 'OpcionController')->middleware(Permisos::nivelMedio());
    Route::post('opcions_nuevo/{pregunta_id}', 'OpcionController@nuevo')->middleware(Permisos::nivelMedio());
    Route::post('guardarOpcion/{respuesta}/{opcion}', 'OpcionController@guardarOpcion')->name('guardarOpcion')->middleware(Permisos::nivelMedio());
    Route::post('guardarOpcionCheck/{opcion}', 'OpcionController@guardarOpcionCheck')->name('guardarOpcionCheck')->middleware(Permisos::nivelMedio());
    Route::resource('examens', 'ExamenController', ['only' => ['store', 'update']])->middleware(Permisos::nivelMedio());
    Route::get('eviar_examen/{evento}', 'ExamenController@eviarExamen')->name("enviar.examen");

    Route::resource('diaFrancos', 'DiaFrancoController', ['only' => ['index', 'store', 'destroy']])->middleware(Permisos::nivelAvanzado());
    Route::get('getAsignar', 'DiaFrancoController@getAsignar')->name('getAsignar')->middleware(Permisos::nivelAvanzado());
    Route::post('asignarFranco/{empleado_id}/{fecha}', 'DiaFrancoController@asignarFranco')->name('asignarFranco')->middleware(Permisos::nivelAvanzado());

    Route::resource('proveedors', 'ProveedorController', ['except' => ['show']])->middleware(Permisos::nivelAvanzado());

    Route::resource('eventos', 'EventoController', ['except' => ['destroy']]);
    Route::resource('participantes', 'ParticipanteController', ['only' => ['index', 'store', 'destroy']]);
    Route::post('seleccionar/{participante}', 'ParticipanteController@seleccionar')->name("participante.seleccionar");


    //instructores
    Route::get('asignacionInstructor', 'EventoInstructorController@index')->name("asignacionInstructor")->middleware(Permisos::nivelMedio());

    //estudiantes
    Route::get('asignacionEstudiante', 'EventoEstudianteController@index')->name("asignacionEstudiante")->middleware(Permisos::nivelInicial());

    //reportes
    Route::get('reportes/getSeguimientoMatrizPorFuncion/{gestion}', 'ReporteController@getSeguimientoMatrizPorFuncion')->name('reportes.getSeguimientoMatrizPorFuncion')->middleware(Permisos::nivelInicial());
    Route::get('reportes/getProximoVencerse/{gestion}', 'ReporteController@getProximoVencerse')->name('reportes.getProximoVencerse')->middleware(Permisos::nivelInicial());
    Route::get('reportes/getHistoricoCapacitacion', 'ReporteController@getHistoricoCapacitacion')->name('reportes.getHistoricoCapacitacion')->middleware(Permisos::nivelMedio());
    Route::get('reportes/getProgramaCapacitacion/{gestion}', 'ReporteController@getProgramaCapacitacion')->name('reportes.getProgramaCapacitacion')->middleware(Permisos::nivelInicial());
    Route::get('reportes/getResumenEvento/{evento_id}', 'ReporteController@getResumenEvento')->name('reportes.getResumenEvento')->middleware(Permisos::nivelMedio());
    Route::get('reportes/getInasistentesCurso', 'ReporteController@getInasistentesCurso')->name('reportes.getInasistentesCurso')->middleware(Permisos::nivelMedio());
    Route::get('reportes/getPersonalWellControl', 'ReporteController@getPersonalWellControl')->name('reportes.getPersonalWellControl')->middleware(Permisos::nivelMedio());
    Route::get('reportes/getConductoresHabilitados', 'ReporteController@getConductoresHabilitados')->name('reportes.getConductoresHabilitados')->middleware(Permisos::nivelMedio());
    Route::get('reportes/getAvanceCursos', 'ReporteController@getAvanceCursos')->name('reportes.getAvanceCursos')->middleware(Permisos::nivelAvanzado());
    Route::get('reportes/getCumplimientoCapacitacion', 'ReporteController@getCumplimientoCapacitacion')->name('reportes.getCumplimientoCapacitacion')->middleware(Permisos::nivelAvanzado());

    Route::resource('preguntaFrecuentes', 'PreguntaFrecuenteController');
});

Route::get('evaluaciones/{evento_id}/{participante}', 'EvaluacionController@index');
Route::resource('respuestas', 'RespuestaController', ['only' => ['store']]);
Route::put('registrar_nota/{id}/{nota}', 'ParticipanteController@registrarNota')->name("registrar.nota");

//json
Route::get('get_material/{curso_id}/{evento}', 'MaterialController@getMaterial')->name('get_material');
Route::get('get_respuesta/{pregunta}', 'PreguntaFrecuenteController@getRespuesta')->name('get_respuesta');


Route::get('test', function(){
    $participante = "Saul Mamani";
    $direccion = 'Av. Jose jordan y magallanes';
    $horario = '12:00 - 14:00';
    $fecha = '12/03/2021';
    $to_email = "luas0_1@yahoo.es";
    $data = array('participante' => $participante, "evento" => 'Relaciones humanas', 'direccion' => $direccion, 'horario' => $horario, 'fecha'=> $fecha);
    Mail::send("emails.mail", $data, function ($message) use ($participante, $to_email) {
        $message->to($to_email, $participante)
            ->subject("San antonio trading - Nuevo evento");
        $message->from("kanito7777777@gmail.com", "San Antonio");
    });

    return "Email enviado correctamente!";
});
