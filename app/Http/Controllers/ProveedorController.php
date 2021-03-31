<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Proveedor;
use App\Repositories\ProveedorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProveedorController extends AppBaseController
{
    /** @var  ProveedorRepository */
    private $proveedorRepository;

    public function __construct(ProveedorRepository $proveedorRepo)
    {
        $this->proveedorRepository = $proveedorRepo;
    }

    public function index(Request $request)
    {
        $txtBuscar = "%";
        if ($request->has('txtBuscar'))
            $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === ""? "%" : $request->txtBuscar;

        $proveedors = Proveedor::where('nombre', 'ilike', '%' . $txtBuscar . '%')->get();;

        return view('proveedors.index')
            ->with('proveedors', $proveedors);
    }


    public function create()
    {
        return view('proveedors.create');
    }

    public function store(CreateProveedorRequest $request)
    {
        $input = $request->all();

        $proveedor = $this->proveedorRepository->create($input);

        Flash::success('Proveedorcreado correctamente.');

        return redirect(route('proveedors.index'));
    }

    public function show($id)
    {
        $proveedor = $this->proveedorRepository->find($id);

        if (empty($proveedor)) {
            Flash::error('Proveedorno encontrado');

            return redirect(route('proveedors.index'));
        }

        return view('proveedors.show')->with('proveedor', $proveedor);
    }

    public function edit($id)
    {
        $proveedor = $this->proveedorRepository->find($id);

        if (empty($proveedor)) {
            Flash::error('Proveedorno encontrado');

            return redirect(route('proveedors.index'));
        }

        return view('proveedors.edit')->with('proveedor', $proveedor);
    }

    public function update($id, UpdateProveedorRequest $request)
    {
        $proveedor = $this->proveedorRepository->find($id);

        if (empty($proveedor)) {
            Flash::error('Proveedorno encontrado');

            return redirect(route('proveedors.index'));
        }

        $proveedor = $this->proveedorRepository->update($request->all(), $id);

        Flash::success('Proveedoractualizado correctamente.');

        return redirect(route('proveedors.index'));
    }

    public function destroy($id)
    {
        $proveedor = $this->proveedorRepository->find($id);

        if (empty($proveedor)) {
            Flash::error('Proveedorno encontrado');

            return redirect(route('proveedors.index'));
        }

        $this->proveedorRepository->delete($id);

        Flash::success('Proveedor eliminado correctamente.');

        return redirect(route('proveedors.index'));
    }
}
