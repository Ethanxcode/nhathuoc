<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CustomerClientPointDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCustomerClientPointRequest;
use App\Http\Requests\UpdateCustomerClientPointRequest;
use App\Repositories\CustomerClientPointRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;
use App\Models\Admin;
use App\Models\Users;

class CustomerClientPointController extends AppBaseController
{
    /** @var  CustomerClientPointRepository */
    private $customerClientPointRepository;

    public function __construct(CustomerClientPointRepository $customerClientPointRepo)
    {
        $this->customerClientPointRepository = $customerClientPointRepo;
    }

    /**
     * Display a listing of the CustomerClientPoint.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CustomerClientPointDataTable())->get())->make(true);
        }
        $clients = Admin::all()->pluck('name', 'id')->toArray();
        $customers = Users::all()->pluck('name', 'id')->toArray();
        return view('backend.customer_client_points.index', compact('clients','customers'));
    }

    /**
     * Show the form for creating a new CustomerClientPoint.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.customer_client_points.create');
    }

    /**
     * Store a newly created CustomerClientPoint in storage.
     *
     * @param CreateCustomerClientPointRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerClientPointRequest $request)
    {
        $input = $request->all();

        $customerClientPoint = $this->customerClientPointRepository->create($input);

        Flash::success('Customer Client Point saved successfully.');

        return redirect(route('customerClientPoints.index'));
    }

    /**
     * Display the specified CustomerClientPoint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customerClientPoint = $this->customerClientPointRepository->find($id);

        if (empty($customerClientPoint)) {
            Flash::error('Customer Client Point not found');

            return redirect(route('customerClientPoints.index'));
        }

        return view('backend.customer_client_points.show')->with('customerClientPoint', $customerClientPoint);
    }

    /**
     * Show the form for editing the specified CustomerClientPoint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customerClientPoint = $this->customerClientPointRepository->find($id);

        if (empty($customerClientPoint)) {
            Flash::error('Customer Client Point not found');

            return redirect(route('customerClientPoints.index'));
        }

        return view('backend.customer_client_points.edit')->with('customerClientPoint', $customerClientPoint);
    }

    /**
     * Update the specified CustomerClientPoint in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerClientPointRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerClientPointRequest $request)
    {
        $customerClientPoint = $this->customerClientPointRepository->find($id);

        if (empty($customerClientPoint)) {
            Flash::error('Customer Client Point not found');

            return redirect(route('customerClientPoints.index'));
        }

        $customerClientPoint = $this->customerClientPointRepository->update($request->all(), $id);

        Flash::success('Customer Client Point updated successfully.');

        return redirect(route('customerClientPoints.index'));
    }

    /**
     * Remove the specified CustomerClientPoint from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customerClientPoint = $this->customerClientPointRepository->find($id);

        $customerClientPoint->delete();

        return $this->sendSuccess('Customer Client Point deleted successfully.');
    }
}