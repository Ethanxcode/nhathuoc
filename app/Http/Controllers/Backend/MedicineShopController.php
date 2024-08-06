<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\MedicineShopDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMedicineShopRequest;
use App\Http\Requests\UpdateMedicineShopRequest;
use App\Repositories\MedicineShopRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;

class MedicineShopController extends AppBaseController
{
    /** @var  MedicineShopRepository */
    private $medicineShopRepository;

    public function __construct(MedicineShopRepository $medicineShopRepo)
    {
        $this->medicineShopRepository = $medicineShopRepo;
    }

    /**
     * Display a listing of the MedicineShop.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new MedicineShopDataTable())->get())->make(true);
        }
    
        return view('medicine_shops.index');
    }

    /**
     * Show the form for creating a new MedicineShop.
     *
     * @return Response
     */
    public function create()
    {
        return view('medicine_shops.create');
    }

    /**
     * Store a newly created MedicineShop in storage.
     *
     * @param CreateMedicineShopRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicineShopRequest $request)
    {
        $input = $request->all();

        $medicineShop = $this->medicineShopRepository->create($input);

        Flash::success('Medicine Shop saved successfully.');

        return redirect(route('medicineShops.index'));
    }

    /**
     * Display the specified MedicineShop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicineShop = $this->medicineShopRepository->find($id);

        if (empty($medicineShop)) {
            Flash::error('Medicine Shop not found');

            return redirect(route('medicineShops.index'));
        }

        return view('medicine_shops.show')->with('medicineShop', $medicineShop);
    }

    /**
     * Show the form for editing the specified MedicineShop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicineShop = $this->medicineShopRepository->find($id);

        if (empty($medicineShop)) {
            Flash::error('Medicine Shop not found');

            return redirect(route('medicineShops.index'));
        }

        return view('medicine_shops.edit')->with('medicineShop', $medicineShop);
    }

    /**
     * Update the specified MedicineShop in storage.
     *
     * @param  int              $id
     * @param UpdateMedicineShopRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicineShopRequest $request)
    {
        $medicineShop = $this->medicineShopRepository->find($id);

        if (empty($medicineShop)) {
            Flash::error('Medicine Shop not found');

            return redirect(route('medicineShops.index'));
        }

        $medicineShop = $this->medicineShopRepository->update($request->all(), $id);

        Flash::success('Medicine Shop updated successfully.');

        return redirect(route('medicineShops.index'));
    }

    /**
     * Remove the specified MedicineShop from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicineShop = $this->medicineShopRepository->find($id);

        $medicineShop->delete();

        return $this->sendSuccess('Medicine Shop deleted successfully.');
    }
}
