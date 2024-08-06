<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\GiftDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGiftRequest;
use App\Http\Requests\UpdateGiftRequest;
use App\Repositories\GiftRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;
use App\Models\GiftType;
use App\Models\Admin;
use App\Models\Gift;

use App\Libs\Urbox;

class GiftController extends AppBaseController
{
    /** @var  GiftRepository */
    private $giftRepository;

    public function __construct(GiftRepository $giftRepo)
    {
        $this->giftRepository = $giftRepo;
    }

    /**
     * Display a listing of the Gift.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new GiftDataTable())->get())->make(true);
        }

        $gift_types = GiftType::all()->pluck('name', 'urbox_type_id')->toArray();
        $clients = Admin::all()->pluck('name', 'id')->toArray();
    
        return view('backend.gifts.index', compact('gift_types', 'clients'));
    }

    /**
     * Show the form for creating a new Gift.
     *
     * @return Response
     */
    public function create()
    {
        $gift_types = GiftType::all()->pluck('name', 'id')->toArray();
        $client = Admin::all()->where('is_admin','!=',1)->pluck('name', 'id')->toArray();
        //dd($gift_types);
        return view('backend.gifts.create', compact('gift_types','client'));
    }

    /**
     * Store a newly created Gift in storage.
     *
     * @param CreateGiftRequest $request
     *
     * @return Response
     */
    public function store(CreateGiftRequest $request)
    {
        $input = $request->all();

        $gift = $this->giftRepository->create($input);

        Flash::success('Gift saved successfully.');

        return redirect(route('gifts.index'));
    }

    /**
     * Display the specified Gift.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gift = $this->giftRepository->find($id);

        if (empty($gift)) {
            Flash::error('Gift not found');

            return redirect(route('gifts.index'));
        }

        return view('backend.gifts.show')->with('gift', $gift);
    }

    /**
     * Show the form for editing the specified Gift.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gift = $this->giftRepository->find($id);
        $gift_types = GiftType::all()->pluck('name', 'id')->toArray();
        $client = Admin::all()->pluck('name', 'id')->toArray();
        if (empty($gift)) {
            Flash::error('Gift not found');

            return redirect(route('gifts.index'));
        }

        return view('backend.gifts.edit', compact('gift', 'gift_types', 'client'));
    }

    /**
     * Update the specified Gift in storage.
     *
     * @param  int              $id
     * @param UpdateGiftRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGiftRequest $request)
    {
        $gift = $this->giftRepository->find($id);

        if (empty($gift)) {
            Flash::error('Gift not found');

            return redirect(route('gifts.index'));
        }

        $gift = $this->giftRepository->update($request->all(), $id);

        Flash::success('Gift updated successfully.');

        return redirect(route('gifts.index'));
    }

    /**
     * Remove the specified Gift from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gift = $this->giftRepository->find($id);

        $gift->delete();

        return $this->sendSuccess('Gift deleted successfully.');
    }

    public function import(){
        $urboxObj = new Urbox();
        $result = $urboxObj->importGift();
        
        $gifts = $result->data->items;
        //var_dump($gifts[0]->office);
        //dd($result);
        
        if($gifts){
            $i = 0;
            foreach($gifts as $_gift){
                
                $gift = Gift::get()->where('urbox_id', $_gift->id)->first();
                if(!$gift){
                    $data = array();
                    $data['title'] = $_gift->title;
                    $gift = $this->giftRepository->create($data);
                }
                if($gift){
                    $client_id = 2;
                    $office = null;
                    if(isset($_gift->client_id) && $_gift->client_id!=""){
                        $client_id = $_gift->client_id;
                    }
                    $gift->title = $_gift->title;
                    $gift->price = $_gift->price;
                    $gift->urbox_id = $_gift->id;
                    $gift->urbox_type_id = $_gift->type;
                    $gift->quantity = $_gift->quantity;
                    $gift->image = $_gift->image;
                    $gift->expired_time = $_gift->expire_duration;
                    $gift->client_id = $client_id;
                    if(isset($_gift->note)){
                        $gift->note =  $_gift->note;
                    }else{
                        $gift->note =  '';
                    }
                    if(isset($_gift->content)){
                        $gift->note =  $_gift->content;
                    }else{
                        $gift->note =  '';
                    }
                    //$gift->content =  $_gift->content;
                    $offices = '';
                    if(isset($_gift->office)){
                        $offices = $_gift->office;
                    }

                    if($offices){
                        foreach($offices as $_office){
                            $office['address'][] =  $_office->address;
                        }
                        $gift->office = json_encode($office);
                    }else{
                        $gift->office = json_encode(array('address' => ''));
                    }
                    $gift->status = 1;
                    $gift->save();
                }

            }
        }
    }
}