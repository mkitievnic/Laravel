<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Models\Curso;
use App\Models\CursoFuncion;
use App\Models\Evento;
use App\Models\Participante;
use App\Patrones\EstadoEvento;
use App\Patrones\Fachada;
use App\Patrones\Permisos;
use App\Repositories\EventoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Mail;
use Response;

class EventoController extends AppBaseController
{
    /** @var  EventoRepository */
    private $eventoRepository;

    public function __construct(EventoRepository $eventoRepo)
    {
        $this->eventoRepository = $eventoRepo;

        $this->middleware(Permisos::nivelInicial())->only(['index', 'show', 'edit']);
        $this->middleware(Permisos::nivelMedio())->only(['index', 'show']);
        $this->middleware(Permisos::nivelAvanzado())->only(['create', 'store', 'update']);
    }

    public function index(Request $request)
    {
        $fechaInicial = $request->has('fecha_inicial') ? Fachada::setDate($request->fecha_inicial) : Fachada::setDate(date('Y') . '-01-01');
        $fechaFinal = $request->has('fecha_final') ? Fachada::setDate($request->fecha_final) : Fachada::setDate(date('Y') . '-12-31');

        $eventos = Evento::with(['usuario', 'curso'])->where('fecha_inicial', '>=', $fechaInicial)->where('fecha_final', '<=', $fechaFinal);

        if (!is_null($request->curso_id)) {
            $eventos->whereCursoId($request->curso_id);
        }
        $eventos = $eventos->orderByDesc('id')->paginate();

        return view('eventos.index', compact('eventos'));
    }

    public function create(Request $request)
    {
        $fechaInicial = $request->has('fecha_inicial') ? Fachada::setDateTime($request->fecha_inicial) : Fachada::getDateServer();
        $fechaFinal = $request->has('fecha_final') ? Fachada::setDateTime($request->fecha_final) : Fachada::getDateServer();;

        $dias = $fechaInicial->diff($fechaFinal)->days;

        $cursosBase = Curso::whereEstado(true);
        if ($request->has('curso_id') && !is_null($request->curso_id))
            $cursosBase->where('id', $request->curso_id);
        $cursosBase = $cursosBase->orderBy('id')->get();

        $cursos = [];
        $i = 0;
        while ($i <= $dias) {
            $fecha = date('Y-m-d', strtotime($fechaInicial->format("Y-m-d") . " + " . $i . " day"));
            $cursos[] = ['fecha' => $fecha, 'cursos' => $cursosBase];
            $i++;
        }

        return view('eventos.create', compact('cursos'));
    }

    public function store(CreateEventoRequest $request)
    {
        $input = $request->all();
        $input['estado'] = EstadoEvento::Pendiente;
        $fecha_inicial = Fachada::setDateTime($request->fecha_inicial);
        $fecha_final = Fachada::setDateTime($request->fecha_final);
        $input['fecha_inicial'] = date('Y-m-d', strtotime($fecha_inicial->format("Y-m-d")));
        $input['fecha_final'] = date('Y-m-d', strtotime($fecha_final->format("Y-m-d")));
        $input['fecha_caducidad'] = date('Y-m-d', strtotime($fecha_final->format("Y-m-d") . " + 2 year"));

        $evento = Evento::create($input);

        //registrando los participantes habilitados
        $fecha = date('Y-m-d', strtotime($evento->fecha_inicial));
        $cursoFunciones = CursoFuncion::with(['funcion', 'funcion.empleados'])->whereCursoId($evento->curso_id)
            ->whereGestion(date('Y', strtotime($fecha)))
            ->whereHas('funcion.empleados.diasFranco', function ($q) use ($fecha) {
                $q->whereFecha($fecha);
            })->get();

        foreach ($cursoFunciones as $row) {
            foreach ($row->funcion->empleados as $empleado) {
                Participante::create([
                    'gestion' => date('Y', strtotime($fecha)),
                    'evento_id' => $evento->id,
                    'empleado_id' => $empleado->id
                ]);
            }
        }

        Flash::success('Evento creado correctamente, deve ser habilitado para que entre en vigencia.');

        return redirect(route('eventos.edit', [$evento]));
    }

    private function sendEmail(Evento $evento, $participante, $email)
    {
        try {
            $direccion = $evento->direccion;
            $horario = $evento->hora_inicial . ' - ' . $evento->hora_final;
            $fecha = $evento->fecha_inicial . ' - ' . $evento->fecha_final;
            $to_email = $email;
            $curso = $evento->curso->codigo . ' | ' . $evento->curso->nombre;
            $evento_id = $evento->id;
            $data = array('participante' => $participante, "evento" => $curso, 'direccion' => $direccion, 'horario' => $horario, 'fecha' => $fecha, 'evento_id' => $evento_id);
            Mail::send("emails.mail", $data, function ($message) use ($participante, $to_email) {
                $message->to($to_email, $participante)
                    ->subject("San antonio trading - Nuevo evento");
                $message->from("kanito7777777@gmail.com", "San Antonio");
            });
            return true;

        }catch (\Exception $e){
            return false;
        }
    }

    public function show($id)
    {
        $evento = Evento::with(['curso', 'participantes.empleado'])->find($id);

        if (empty($evento)) {
            Flash::error('Evento no encontrado');

            return redirect(route('eventos.index'));
        }
        $evento->setHidden(['informe', 'created_at', 'deleted_at', 'updated_at', 'usuario_id', 'curso_id']);

        $noEnviados = [];
        foreach ($evento->participantes as $row)
        {
            if($row->es_seleccionado)
            {
                if(!$this->sendEmail($evento,
                        $row->empleado->nombre . ' ' . $row->empleado->apellido_paterno . ' ' . $row->empleado->apellido_materno,
                                        $row->empleado->email))
                    $noEnviados[] = $row->empleado->email;
            }
        }

        return response()->json(['msg' => 'Correos enviados correctamente', 'No se ha podido enviar a: '=> $noEnviados], 200);
    }

    public function edit($id)
    {
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            Flash::error('Evento no encontrado');
            return redirect(route('eventos.index'));
        }

        //borrando toos los participantes seleccionados
        Participante::whereEventoId($evento->id)->update(['es_seleccionado' => false]);

        return view('eventos.edit', compact('evento'));
    }

    public function update($id, UpdateEventoRequest $request)
    {
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            Flash::error('Evento no encontrado');
            return redirect(route('eventos.index'));
        }

        $fechaInicial = Fachada::setDate($request->fecha_inicial);
        $fechaFinal = Fachada::setDate($request->fecha_final);

        if ($fechaInicial > $fechaFinal) {
            Flash::error('La fecha inicial no puede ser mayor a la fecha final');
            return redirect(route('eventos.edit', [$evento]));
        }

        if($request->has('btnPublicar')) {
            $input = $request->all();
            $input['estado'] = EstadoEvento::EnEjecucion;
            $fecha_final = Fachada::setDateTime($request->fecha_final);
            $input['fecha_caducidad'] = date('Y-m-d', strtotime($fecha_final . " + 2 year"));

            $evento = $this->eventoRepository->update($input, $id);
            Flash::success('Evento publicado correctamente.');
            return redirect(route('eventos.index'));
        }
        if($request->has('btnCancelar'))
        {
            $evento->estado = EstadoEvento::Cancelado;
            $evento->save();

            //enviar emails evento cancelado
            $this->enviarEmailCancelado($evento);

            Flash::success('Evento cancelado correctamente.');
        }
        if($request->has('btnFinalizar'))
        {
            $evento->estado = EstadoEvento::Finalizado;
            $evento->save();
            Flash::success('Evento finalizado correctamente.');
        }

        if($request->has('btnInforme'))
        {
            $evento->informe = $request->informe;
            $evento->save();
            Flash::success('Informe guardado correctamente.');
        }
        return redirect(route('eventos.edit', [$evento]));
    }

    private function enviarEmailCancelado(Evento $evento)
    {
        $participantesSeleccionados =  Participante::whereEventoId($evento->id)->whereEsSeleccionado(true)->get();

        $noEnviados = [];

        $participantes = [];
        foreach ($participantesSeleccionados as $participante) {
            $data = [
                'evento' => $evento->curso->codigo . ': ' . $evento->curso->nombre,
                'nombre' => $participante->empleado->nombre_completo,
                'email' =>$participante->empleado->email,
            ];
            $participantes[] = $data;
            if(!$this->sendEmailCancelado($data))
                $noEnviados[] = $participante->empleado->email;
        }

        return true;
    }

    private function sendEmailCancelado($data)
    {
        try {
            $to_email = $data['email'];
            $nombre = $data['nombre'];
            $data = array('data' => $data);
            Mail::send("emails.cancelar-mail", $data, function ($message) use ($nombre, $to_email) {
                $message->to($to_email, $nombre)
                    ->subject("San antonio trading - Evento cancelado");
                $message->from("kanito7777777@gmail.com", "San Antonio");
            });
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
}
