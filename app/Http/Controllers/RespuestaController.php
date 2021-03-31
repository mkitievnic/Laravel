<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use App\Patrones\Fachada;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    public function store(Request $request)
    {
        try {
            //verificando si ya ha sido registrado
            $respuesta = Respuesta::whereParticipanteId($request->participante_id)->wherePreguntaId($request->pregunta_id)->whereExamenId($request->examen_id)->first();
            if(!is_null($respuesta))
                $respuesta->delete();

            $input = $request->all();
            $fecha = Fachada::getDateTime();
            $input['fecha'] = date('Y-m-d H:i:s', strtotime($fecha));
            Respuesta::create($input);
            return response()->json(['res' => true, 'message' => 'respuesta registrada correctamente!']);
        } catch (\Exception $e) {
            return response()->json(['res' => false, 'message' => $e->getMessage()]);
        }
    }
}
