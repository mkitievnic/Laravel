<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Models\Instructor;
use App\Patrones\Rol;
use App\Repositories\InstructorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class InstructorController extends AppBaseController
{
    /** @var  InstructorRepository */
    private $instructorRepository;

    public function __construct(InstructorRepository $instructorRepo)
    {
        $this->instructorRepository = $instructorRepo;
    }

    public function index(Request $request)
    {
        $txtBuscar = "%";
        if ($request->has('txtBuscar'))
            $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === "" ? "%" : $request->txtBuscar;

        $instructors = Instructor::where('ci', 'ilike', '%' . $txtBuscar . '%')
            ->orWhere('nombre', 'ilike', '%' . $txtBuscar . '%')
            ->orWhere('apellido_paterno', 'ilike', '%' . $txtBuscar . '%')
            ->orWhere('apellido_materno', 'ilike', '%' . $txtBuscar . '%')
            ->orderBy('id')->paginate();

        return view('instructors.index')
            ->with('instructors', $instructors);
    }

    public function create()
    {
        return view('instructors.create');
    }

    public function store(CreateInstructorRequest $request)
    {
        \DB::beginTransaction();
        try {
            $input = $request->all();

            $instructor = $this->instructorRepository->create($input);
            $instructor->usuario()->create([
                "email" => $request->email,
                "nivel" => Rol::Medio
            ]);

            Flash::success('Instructor guardado correctamente.');

            \DB::commit();

            return redirect(route('instructors.index'));
        } catch (\Exception $e) {
            \DB::rollback();
            Flash::error('Ha ocurrido un error, vuelva a intentarlo.   ' . $e->getMessage());
            return redirect(route('instructors.index'));
        } catch (\Throwable $e) {
            \DB::error();
            Flash::success('Ha ocurrido un error, vuelva a intentarlo.    ' . $e->getMessage());
            return redirect(route('instructors.index'));
        }
    }

    public function edit($id)
    {
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            Flash::error('Instructor no encontrado');

            return redirect(route('instructors.index'));
        }

        return view('instructors.edit')->with('instructor', $instructor);
    }

    public function update($id, UpdateInstructorRequest $request)
    {
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            Flash::error('Instructor no encontrado');

            return redirect(route('instructors.index'));
        }

        $instructor = $this->instructorRepository->update($request->all(), $id);

        Flash::success('Instructor modificado correctamente.');

        return redirect(route('instructors.index'));
    }

    public function destroy($id)
    {
        $instructor = $this->instructorRepository->find($id);

        if (empty($instructor)) {
            Flash::error('Instructor no encontrado');

            return redirect(route('instructors.index'));
        }

        $this->instructorRepository->delete($id);

        Flash::success('Instructor eliminado correctamente.');

        return redirect(route('instructors.index'));
    }
}
