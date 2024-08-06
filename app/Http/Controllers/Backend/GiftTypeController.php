<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\GiftTypeDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGiftTypeRequest;
use App\Http\Requests\UpdateGiftTypeRequest;
use App\Repositories\GiftTypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;
use App\Models\GiftType;
use DB;

class GiftTypeController extends AppBaseController
{
    /** @var  GiftTypeRepository */
    private $giftTypeRepository;

    public function __construct(GiftTypeRepository $giftTypeRepo)
    {
        $this->giftTypeRepository = $giftTypeRepo;
    }

    /**
     * Display a listing of the GiftType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new GiftTypeDataTable())->get())->make(true);
        }
    
        return view('backend.gift_types.index');
    }

    /**
     * Show the form for creating a new GiftType.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.gift_types.create');
    }

    /**
     * Store a newly created GiftType in storage.
     *
     * @param CreateGiftTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateGiftTypeRequest $request)
    {
        $input = $request->all();

        $giftType = $this->giftTypeRepository->create($input);

        Flash::success('Gift Type saved successfully.');

        return redirect(route('giftTypes.index'));
    }

    /**
     * Display the specified GiftType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $giftType = $this->giftTypeRepository->find($id);

        if (empty($giftType)) {
            Flash::error('Gift Type not found');

            return redirect(route('giftTypes.index'));
        }

        return view('backend.gift_types.show')->with('giftType', $giftType);
    }

    /**
     * Show the form for editing the specified GiftType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $giftType = $this->giftTypeRepository->find($id);

        if (empty($giftType)) {
            Flash::error('Gift Type not found');

            return redirect(route('giftTypes.index'));
        }

        return view('backend.gift_types.edit')->with('giftType', $giftType);
    }

    /**
     * Update the specified GiftType in storage.
     *
     * @param  int              $id
     * @param UpdateGiftTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGiftTypeRequest $request)
    {
        $giftType = $this->giftTypeRepository->find($id);

        if (empty($giftType)) {
            Flash::error('Gift Type not found');

            return redirect(route('giftTypes.index'));
        }

        $giftType = $this->giftTypeRepository->update($request->all(), $id);

        Flash::success('Gift Type updated successfully.');

        return redirect(route('giftTypes.index'));
    }

    /**
     * Remove the specified GiftType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $giftType = $this->giftTypeRepository->find($id);

        $giftType->delete();

        return $this->sendSuccess('Gift Type deleted successfully.');
    }

    public function import(){
        $gift_types = array(
            1 => "Voucher tiền mặt", 2 => "Giftset", 3 => "Combo", 4 => "Thẻ balance", 
            5 => "Thẻ điện thoại", 6 => "Topup điện thoại", 7 => "Thẻ điểm", 
            8 => "Topup điểm", 9 => "Vật lý", 10 => "Item (Sản phẩm cụ thể)", 11 => "Voucher khuyến mãi", 
            12 => "Bảo hiểm", 14 => "Lượt quay số", 15 => "Premium Service"
            );
        $flg = true;
        foreach($gift_types as $key => $gift_type_item){
            
            $gift_type = GiftType::get()->where('urbox_type_id', $key)->first();
            if(!$gift_type){
                $data = array();
                $data['name'] = $gift_type_item;
                $data['urbox_type_id'] = (int)$key;
                $data['status'] = 1;
                $_gift_type = $this->giftTypeRepository->create($data);
                //$_gift_type = DB::insert('insert into gift_types(name, urbox_type_id, status) values(?,?,?)', [$gift_type_item, $key, 1]);
                $_gift_type->urbox_type_id = $key;
                $_gift_type->save();
                if(!$_gift_type){
                    $flg = false;
                }
            }
        }
        $result['message'] = 'Import gift type thành công.';
        if(!$flg){
            $result['message'] = 'Import gift type bị lỗi';
        }
        echo json_encode($result);
    }
}