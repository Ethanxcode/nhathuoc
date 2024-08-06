<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CustomerPointDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCustomerPointRequest;
use App\Http\Requests\UpdateCustomerPointRequest;
use App\Repositories\CustomerPointRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;
use App\Models\Users;
use App\Models\Gift;
use App\Models\Product;

class CustomerPointController extends AppBaseController
{
    /** @var  CustomerPointRepository */
    private $customerPointRepository;

    public function __construct(CustomerPointRepository $customerPointRepo)
    {
        $this->customerPointRepository = $customerPointRepo;
    }

    /**
     * Display a listing of the CustomerPoint.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CustomerPointDataTable())->get())->make(true);
        }
    
        $customers = Users::all()->pluck('name', 'id')->toArray();
        $products = Product::all()->pluck('product_name', 'id')->toArray();
    
        return view('backend.customer_points.index', compact('customers','products'));
    }

    /**
     * Show the form for creating a new CustomerPoint.
     *
     * @return Response
     */
    public function create()
    {
        $customers = Users::all()->pluck('name', 'id')->toArray();
        $products = Product::all()->pluck('product_name', 'id')->toArray();
        return view('customer_points.create', compact('customers','products'));
    }

    /**
     * Store a newly created CustomerPoint in storage.
     *
     * @param CreateCustomerPointRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerPointRequest $request)
    {
        $input = $request->all();

        $customerPoint = $this->customerPointRepository->create($input);

        Flash::success('Customer Point saved successfully.');

        return redirect(route('customerPoints.index'));
    }

    /**
     * Display the specified CustomerPoint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customerPoint = $this->customerPointRepository->find($id);

        if (empty($customerPoint)) {
            Flash::error('Customer Point not found');

            return redirect(route('customerPoints.index'));
        }

        return view('customer_points.show')->with('customerPoint', $customerPoint);
    }

    /**
     * Show the form for editing the specified CustomerPoint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customerPoint = $this->customerPointRepository->find($id);

        if (empty($customerPoint)) {
            Flash::error('Customer Point not found');

            return redirect(route('customerPoints.index'));
        }

        return view('customer_points.edit')->with('customerPoint', $customerPoint);
    }

    /**
     * Update the specified CustomerPoint in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerPointRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerPointRequest $request)
    {
        $customerPoint = $this->customerPointRepository->find($id);

        if (empty($customerPoint)) {
            Flash::error('Customer Point not found');

            return redirect(route('customerPoints.index'));
        }

        $customerPoint = $this->customerPointRepository->update($request->all(), $id);

        Flash::success('Customer Point updated successfully.');

        return redirect(route('customerPoints.index'));
    }

    /**
     * Remove the specified CustomerPoint from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customerPoint = $this->customerPointRepository->find($id);

        $customerPoint->delete();

        return $this->sendSuccess('Customer Point deleted successfully.');
    }
}