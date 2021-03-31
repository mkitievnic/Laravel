<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectorRequest;
use App\Http\Requests\UpdateSectorRequest;
use App\Models\Sector;
use App\Repositories\SectorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SectorController extends AppBaseController
{
    /** @var  SectorRepository */
    private $sectorRepository;

    public function __construct(SectorRepository $sectorRepo)
    {
        $this->sectorRepository = $sectorRepo;
    }

    public function index(Request $request)
    {
        $txtBuscar = "%";
        if ($request->has('txtBuscar'))
            $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === ""? "%" : $request->txtBuscar;

        $sectors = Sector::where('nombre', 'ilike', '%' . $txtBuscar . '%')->get();

        return view('sectors.index')
            ->with('sectors', $sectors);
    }

    public function create()
    {
        return view('sectors.create');
    }

    public function store(CreateSectorRequest $request)
    {
        $input = $request->all();

        $sector = $this->sectorRepository->create($input);

        Flash::success('Sector guardado correctamente.');

        return redirect(route('sectors.index'));
    }

    public function show($id)
    {
        $sector = $this->sectorRepository->find($id);

        if (empty($sector)) {
            Flash::error('Sector no encontrado');

            return redirect(route('sectors.index'));
        }

        return view('sectors.show')->with('sector', $sector);
    }

    public function edit($id)
    {
        $sector = $this->sectorRepository->find($id);

        if (empty($sector)) {
            Flash::error('Sector no encontrado');

            return redirect(route('sectors.index'));
        }

        return view('sectors.edit')->with('sector', $sector);
    }

    public function update($id, UpdateSectorRequest $request)
    {
        $sector = $this->sectorRepository->find($id);

        if (empty($sector)) {
            Flash::error('Sector no encontrado');

            return redirect(route('sectors.index'));
        }

        $sector = $this->sectorRepository->update($request->all(), $id);

        Flash::success('Sector modificado correctamente.');

        return redirect(route('sectors.index'));
    }

    public function destroy($id)
    {
        $sector = $this->sectorRepository->find($id);

        if (empty($sector)) {
            Flash::error('Sector no encontrado');

            return redirect(route('sectors.index'));
        }

        $this->sectorRepository->delete($id);

        Flash::success('Sector eliminado correctamente.');

        return redirect(route('sectors.index'));
    }
}
