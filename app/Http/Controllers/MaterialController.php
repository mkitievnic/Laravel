<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Curso;
use App\Models\Evento;
use App\Models\Material;
use App\Models\Participante;
use App\Repositories\MaterialRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Mail;
use Response;

class MaterialController extends AppBaseController
{
    /** @var  MaterialRepository */
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepo)
    {
        $this->materialRepository = $materialRepo;
    }

    public function index(Request $request)
    {
        $materials = $this->materialRepository->all()->where('curso_id', $request->curso_id);
        $curso = Curso::findOrFail($request->curso_id);

        return view('materials.index', compact('materials', 'curso'));
    }

    private function subirArchivo($file, $curso)
    {
        if(is_null($file))
        {
            Flash::error('Elija imagenes validas. (*.pdf. *.docx, *.doc, *.jpg, *.jpeg, *.png)');
            return redirect(route('materials.index', ['curso_id' => $curso->id]));

        }
        $nombreArchivo = $curso->id .'_'. time();

        $file->move(public_path('materiales'), $nombreArchivo.'.'.$file->getClientOriginalExtension());
        return ['archivo' => $nombreArchivo, 'ext' => $file->getClientOriginalExtension()];
    }

    public function store(CreateMaterialRequest $request)
    {
        $input = $request->all();
        $curso = Curso::findOrFail($request->curso_id);

        $archivo = $this->subirArchivo($request->url, $curso);
        $input['url'] = $archivo['archivo'].'.'. $archivo['ext'];

        $material = $this->materialRepository->create($input);

        Flash::success('Material agregado correctamente.');

        return redirect(route('materials.index', ['curso_id' => $curso->id]));
    }

    public function destroy($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material no encontrado');
            return redirect(route('materials.index'));
        }

        $this->materialRepository->delete($id);

        Flash::success('Material eliminado correctamente.');

        return redirect(route('materials.index',  ['curso_id' => $material->curso_id]));
    }

    public function getMaterial($curso_id, Evento $evento){
        $participantesSeleccionados =  Participante::whereEventoId($evento->id)->whereEsSeleccionado(true)->get();
        $materiales = Material::with('curso')->whereCursoId($curso_id)->get();

        if(count($materiales) <= 0)
            return response()->json(['res' => false, 'msg' => 'No existe material cargado para este curso']);

        $participantes = [];
        $noEnviados = [];
        foreach ($participantesSeleccionados as $participante) {
            $data = [
                'evento' => $evento->curso->codigo . ': ' . $evento->curso->nombre,
                'nombre' => $participante->empleado->nombre_completo,
                'email' =>$participante->empleado->email,
                'url' => url('/') . '/materiales/' .  (count($materiales)> 0 ? $materiales[0]->url : 'xxx')
            ];

            $participantes[] = $data;

            if(!$this->sendEmail($data))
                $noEnviados[] = $participante->empleado->email;
        }


        return response()->json(['msg' => 'Correos enviados correctamente', 'No se ha podido enviar a: '=> $noEnviados, 'materiales' => $materiales->makeHidden(['id']), 'data' => $participantes], 200);
    }

    private function sendEmail($data)
    {
        try {
            $to_email = $data['email'];
            $nombre = $data['nombre'];
            $data = array('data' => $data);
            Mail::send("emails.material-mail", $data, function ($message) use ($nombre, $to_email) {
                $message->to($to_email, $nombre)
                    ->subject("San antonio trading - Material evento");
                $message->from("kanito7777777@gmail.com", "San Antonio");
            });
            return true;

        }catch (\Exception $e){
            return false;
        }
    }
}
