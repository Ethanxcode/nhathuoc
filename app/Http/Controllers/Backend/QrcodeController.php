<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\QrcodeDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateQrcodeRequest;
use App\Http\Requests\UpdateQrcodeRequest;
use App\Repositories\QrcodeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Datatables;
use App\Models\Product;
use PDF;
use App\Models\Admin;
use Hash;
use QRcode;

class QrcodeController extends AppBaseController
{
    /** @var  QrcodeRepository */
    private $qrcodeRepository;

    public function __construct(QrcodeRepository $qrcodeRepo)
    {
        $this->qrcodeRepository = $qrcodeRepo;
    }

    /**
     * Display a listing of the Qrcode.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new QrcodeDataTable())->get())->make(true);
        }

        $products = Product::all()->pluck('product_name','id')->toArray();
        
        return view('backend.qrcodes.index', compact('products'));
    }

    /**
     * Show the form for creating a new Qrcode.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.qrcodes.create');
    }

    /**
     * Store a newly created Qrcode in storage.
     *
     * @param CreateQrcodeRequest $request
     *
     * @return Response
     */
    public function store(CreateQrcodeRequest $request)
    {
        $input = $request->all();

        $qrcode = $this->qrcodeRepository->create($input);

        Flash::success('Qrcode saved successfully.');

        return redirect(route('qrcodes.index'));
    }

    /**
     * Display the specified Qrcode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $qrcode = $this->qrcodeRepository->find($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        return view('backend.qrcodes.show')->with('qrcode', $qrcode);
    }

    /**
     * Show the form for editing the specified Qrcode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $qrcode = $this->qrcodeRepository->find($id);
        $products = Product::all()->pluck('product_name', 'id')->toArray();
        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        return view('backend.qrcodes.edit',compact('qrcode','products'));
    }

    /**
     * Update the specified Qrcode in storage.
     *
     * @param  int              $id
     * @param UpdateQrcodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQrcodeRequest $request)
    {
        $qrcode = $this->qrcodeRepository->find($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        $qrcode = $this->qrcodeRepository->update($request->all(), $id);

        Flash::success('Qrcode updated successfully.');

        return redirect(route('qrcodes.index'));
    }

    /**
     * Remove the specified Qrcode from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $qrcode = $this->qrcodeRepository->find($id);

        $qrcode->delete();

        return $this->sendSuccess('Qrcode deleted successfully.');
    }

    public function generate($pid, $qty){
        
    }

    public function generateQrCode($pid = 1, $qty = 0){
        $pid = 1;
        $product = Product::get()->where('id', $pid)->first();
        if($product){
            $client = Admin::get()->where('id', $product->client_id)->first();
        }

        if($client){
            $hash = Hash::make('@123456*9');
            $checksum = Hash::make($hash);
            $html =  '<ul>';
            for($i=0; $i < 101; $i++){
                $_qrcode_co = Hash::make($hash.$product->sku.$i);
                
                $code =  'http://meddeal.com.vn/qrcode-loyalty?code='.$_qrcode_co.'&productCode='.$product->sku;
                $qrcode = \QrCode::size(250)->generate($code, public_path('images/qrcode.png'));
                $html.= '<li>';
                $html.'<label style="display:block;">'.$product->product_name.'</label>';
                $html.'<label style="display:block;">'.$product->sku.'</label>';
                $html.='<div><img src="'.$qrcode.'" /></div>';
                $html.='</li>';
            }
            $html.= '</ul>';
            PDF::SetTitle('Generate QR Code '.$client->name);
            PDF::AddPage();
            PDF::writeHTML($html);

            PDF::Output('hello_world.pdf');
        }
        // $html='<html><head>';
        // $html.='<style>';
        // $html.='';
        // $html.='</style>';
        // $html.='</head><body>';
        // $html.='<h1>Hello World</h1>';
        // $html.='<table>';
        // $html.='<tr>';
        // for($i = 0; $i < 100; $i++){
        //     if($i%4 == 0) $html.='</tr><tr>';
        //     $html.='<td>';
        //     $html.='<div>';
        //     $html.='<label style="display:block;">'.$product->product_name.'</label>';
        //     $html.='</div>';
        //     $html.='</td>';
        // }
        // $html.='</tr>';
        // $html.='</table>';
        // $html.= '</body></html>';
        
        // PDF::SetTitle('Hello World');
        // PDF::AddPage();
        // PDF::writeHTML($html, true, false, true, false, '');

        // PDF::Output('hello_world.pdf');
    }
}