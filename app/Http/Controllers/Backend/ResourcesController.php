<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ResourcesDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateResourcesRequest;
use App\Http\Requests\UpdateResourcesRequest;
use App\Repositories\ResourcesRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;

class ResourcesController extends AppBaseController
{
    /** @var  ResourcesRepository */
    private $resourcesRepository;

    public function __construct(ResourcesRepository $resourcesRepo)
    {
        $this->resourcesRepository = $resourcesRepo;
    }

    /**
     * Display a listing of the Resources.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new ResourcesDataTable())->get())->make(true);
        }
    
        return view('backend.resources.index');
    }

    /**
     * Show the form for creating a new Resources.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.resources.create');
    }

    /**
     * Store a newly created Resources in storage.
     *
     * @param CreateResourcesRequest $request
     *
     * @return Response
     */
    public function store(CreateResourcesRequest $request)
    {
        $input = $request->all();

        $resources = $this->resourcesRepository->create($input);

        Flash::success('Resources saved successfully.');

        return redirect(route('resources.index'));
    }

    /**
     * Display the specified Resources.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $resources = $this->resourcesRepository->find($id);

        if (empty($resources)) {
            Flash::error('Resources not found');

            return redirect(route('resources.index'));
        }

        return view('backend.resources.show')->with('resources', $resources);
    }

    /**
     * Show the form for editing the specified Resources.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $resources = $this->resourcesRepository->find($id);

        if (empty($resources)) {
            Flash::error('Resources not found');

            return redirect(route('resources.index'));
        }

        return view('backend.resources.edit')->with('resources', $resources);
    }

    /**
     * Update the specified Resources in storage.
     *
     * @param  int              $id
     * @param UpdateResourcesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResourcesRequest $request)
    {
        $resources = $this->resourcesRepository->find($id);

        if (empty($resources)) {
            Flash::error('Resources not found');

            return redirect(route('resources.index'));
        }

        $resources = $this->resourcesRepository->update($request->all(), $id);

        Flash::success('Resources updated successfully.');

        return redirect(route('resources.index'));
    }

    /**
     * Remove the specified Resources from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $resources = $this->resourcesRepository->find($id);

        $resources->delete();

        return $this->sendSuccess('Resources deleted successfully.');
    }
}
