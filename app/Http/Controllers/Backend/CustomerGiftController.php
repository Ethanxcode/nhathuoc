<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CustomerGiftDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCustomerGiftRequest;
use App\Http\Requests\UpdateCustomerGiftRequest;
use App\Repositories\CustomerGiftRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;
use App\Models\Users;
use App\Models\Gift;

class CustomerGiftController extends AppBaseController
{
    /** @var  CustomerGiftRepository */
    private $customerGiftRepository;

    public function __construct(CustomerGiftRepository $customerGiftRepo)
    {
        $this->customerGiftRepository = $customerGiftRepo;
    }

    /**
     * Display a listing of the CustomerGift.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CustomerGiftDataTable())->get())->make(true);
        }

        $customers = Users::all()->pluck('name', 'id')->toArray();
        $gifts = Gift::all()->pluck('name', 'id')->toArray();
    
        return view('backend.customer_gifts.index', compact('customers', 'gifts'));
    }

    /**
     * Show the form for creating a new CustomerGift.
     *
     * @return Response
     */
    public function create()
    {
        $gifts = Gift::all()->pluck('name', 'id')->toArray();
        $customers = Users::all()->pluck('name','id')->toArray();
        return view('backend.customer_gifts.create', compact('gifts','customers'));
    }

    /**
     * Store a newly created CustomerGift in storage.
     *
     * @param CreateCustomerGiftRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerGiftRequest $request)
    {
        $input = $request->all();

        $customerGift = $this->customerGiftRepository->create($input);

        Flash::success('Customer Gift saved successfully.');

        return redirect(route('customerGifts.index'));
    }

    /**
     * Display the specified CustomerGift.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customerGift = $this->customerGiftRepository->find($id);

        if (empty($customerGift)) {
            Flash::error('Customer Gift not found');

            return redirect(route('customerGifts.index'));
        }

        return view('backend.customer_gifts.show')->with('customerGift', $customerGift);
    }

    /**
     * Show the form for editing the specified CustomerGift.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customerGift = $this->customerGiftRepository->find($id);

        if (empty($customerGift)) {
            Flash::error('Customer Gift not found');

            return redirect(route('customerGifts.index'));
        }
        $customers = Users::all()->pluck('name', 'id')->toArray();
        $gifts = Gift::all()->pluck('name', 'id')->toArray();
    

        return view('backend.customer_gifts.edit', compact('customers','gifts'))->with('customerGift', $customerGift);
    }

    /**
     * Update the specified CustomerGift in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerGiftRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerGiftRequest $request)
    {
        $customerGift = $this->customerGiftRepository->find($id);

        if (empty($customerGift)) {
            Flash::error('Customer Gift not found');

            return redirect(route('customerGifts.index'));
        }

        $customerGift = $this->customerGiftRepository->update($request->all(), $id);

        Flash::success('Customer Gift updated successfully.');

        return redirect(route('customerGifts.index'));
    }

    /**
     * Remove the specified CustomerGift from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customerGift = $this->customerGiftRepository->find($id);

        $customerGift->delete();

        return $this->sendSuccess('Customer Gift deleted successfully.');
    }
}