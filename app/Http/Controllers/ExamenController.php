<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExamenRequest;
use App\Http\Requests\UpdateExamenRequest;
use App\Models\Evento;
use App\Models\Participante;
use App\Patrones\Fachada;
use App\Repositories\ExamenRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Mail;
use Response;

class ExamenController extends AppBaseController
{
    /** @var  ExamenRepository */
    private $examenRepository;

    public function __construct(ExamenRepository $examenRepo)
    {
        $this->examenRepository = $examenRepo;
    }

    public function store(CreateExamenRequest $request)
    {
        $input = $request->all();

        $fecha_inicial = Fachada::setDateTime($request->fecha_inicial);
        $fecha_final = Fachada::setDateTime($request->fecha_final);
        $input['fecha_inicial'] = date('Y-m-d', strtotime($fecha_inicial->format("Y-m-d")));
        $input['fecha_final'] = date('Y-m-d', strtotime($fecha_final->format("Y-m-d")));
        $examen = $this->examenRepository->create($input);

        Flash::success('Examen registrado correctamente.');

        return redirect(route('eventos.edit', [$examen->evento]));
    }

    public function update($id, UpdateExamenRequest $request)
    {
        $input = $request->all();
        $fecha_inicial = Fachada::setDateTime($request->fecha_inicial);
        $fecha_final = Fachada::setDateTime($request->fecha_final);
        $input['fecha_inicial'] = date('Y-m-d', strtotime($fecha_inicial->format("Y-m-d")));
        $input['fecha_final'] = date('Y-m-d', strtotime($fecha_final->format("Y-m-d")));
        $examen = $this->examenRepository->update($input, $id);

        Flash::success('Examen actualizado correctamente.');

        return redirect(route('eventos.edit', [$examen->evento]));
    }

    public function eviarExamen(Evento $evento)
    {
        $participantesSeleccionados =  Participante::whereEventoId($evento->id)->whereEsSeleccionado(true)->get();

        $noEnviados = [];

        $participantes = [];
        foreach ($participantesSeleccionados as $participante) {
            $data = [
                'evento' => $evento->curso->codigo . ': ' . $evento->curso->nombre,
                'telefono' => $participante->empleado->telefono,
                'nombre' => $participante->empleado->nombre_completo,
                'email' =>$participante->empleado->email,
                'fecha_inicial' => $evento->examen->fecha_inicial,
                'fecha_final' => $evento->examen->fecha_final,
                'tiempo' => $evento->examen->tiempo,
                'descripcion' => $evento->examen->descripcion,
                'url' => url("evaluaciones/" . $evento->id . "/" . $participante->id)
            ];

            $participantes[] = $data;

            if(!$this->sendEmail($data))
                $noEnviados[] = $participante->empleado->email;
        }

        return response()->json(['msg' => 'Correos enviados correctamente', 'No se ha podido enviar a: '=> $noEnviados, 'data' => $participantes], 200);
    }

    private function sendEmail($participante)
    {
        try {
            $to_email = $participante['email'];
            $nombre = $participante['nombre'];
            $data = array('data' => $participante);
            Mail::send("emails.examen-mail", $data, function ($message) use ($nombre, $to_email) {
                $message->to($to_email, $nombre)
                    ->subject("San antonio trading - Examen evento");
                $message->from("kanito7777777@gmail.com", "San Antonio");
            });
            return true;

        }catch (\Exception $e){
            return false;
        }
    }
}
