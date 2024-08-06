<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Auth;
use DB;
use App\Models\Product;
use App\Models\Qrcode;
use App\Http\Requests\QrLoyaltyRequest;
use Validator;
use App\Repositories\QrcodeRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CustomerPointRepository;
use App\Repositories\CustomerClientPointRepository;
use App\Models\CustomerClientPoint;

class QrLoyaltyController extends Controller
{
    /** @var  QrcodeRepository */
    /** @var  ProductRepository */
    private $qrcodeRepository;
    private $productRepository;
    private $customerPointRepository;
    public function __construct(QrcodeRepository $qrcodeRepository, ProductRepository $productRepository, 
    CustomerPointRepository $customerPointRepository)
    {
        $this->qrcodeRepository = $qrcodeRepository;
        $this->productRepository = $productRepository;
        $this->customerPointRepository = $customerPointRepository;
    }
    
    /**
     * Display a listing of the resource.
     * @param QrLoyaltyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $input = $request->input();
        $rules = [
            'campaignId' => 'required',
            'checksum' => 'required',
            'code' => 'required',
            'productCode' => 'required',
            'vendorId' => 'required',
        ];
        $messages = [
            'campaignId.required' => 'Thiếu :attribute',
            'checksum.required' => 'Thiếu :attribute',
            'code.required' => 'Thiếu :attribute',
            'productCode.required' => 'Thiếu :attribute',
            'vendorId.required' => 'Thiếu :attribute',
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        
        $_messages = $validator->errors()->messages();
        
        $user = Users::get()->where('id',Auth::user()->id)->first();
        $_qrcode = '';
        $_product = '';
        $product = '';
        $_qr_code_message = '';
        $_message  = '';
        
        if(empty($_messages) == true){
            
            //$qrcode = Qrcode::get()->where('qr_code',$input['code']);
            $qrcode = Qrcode::get()->where('qr_code', $input['code'])->first();
            //$product = Product::get()->where('sku', $input['productCode'])->first();
            $product = Product::where('sku','like','%'.$input['productCode'].'%')->get()->first();
        

            if($product){
                $data['product_id'] = $product->id;
                $data['qr_code'] = $input['code'];
                $data['status'] = 1;
                if(!$qrcode){
                    $_qrcode = $this->qrcodeRepository->create($data);
                }
                
                if($_qrcode){
                    $data_customer_point['user_id'] = Auth::user()->id;
                    $data_customer_point['product_id'] = $product->id;
                    $data_customer_point['points'] = $product->points;
                    $_product = $this->customerPointRepository->create($data_customer_point);

                    $customer_cilent_point = CustomerClientPoint::where(['user_id' =>  Auth::user()->id, 'client_id' => $product->client_id])->get()->first();
                                 
                    if($customer_cilent_point){
                        $customer_cilent_point->total_points = $customer_cilent_point->total_points + $product->points;
                        $customer_cilent_point->save();
                    }else{
                        $_customer_cilent_point_data = array();
                        $_customer_cilent_point_data['user_id'] = Auth::user()->id;
                        $_customer_cilent_point_data['client_id'] = $product->client_id;
                        $_customer_cilent_point_data['total_points'] = $product->points;
                        CustomerClientPoint::create($_customer_cilent_point_data);
                    }

                }
            }else{
                $_message = "Sản phẩm với QR  code ".$input['code']." không có trong chương trình đổi điểm hoặc không phải là sản phẩm được sử dụng trong đợt này. Khách hàng vui lòng quét thêm sản phẩm khác.";
            }
            if($_message == ''){
                if($qrcode){
                    $product = Product::get()->where('id', $qrcode->product_id)->first();
                    $_qr_code_message = "Sản phẩm '".$product->product_name."' với QR code '".$qrcode->qr_code."' đã được sử dụng. Vui lòng quét sản phẩm khác để tích điễm đổi quà.";    
                }
            }
        }else{
            if(isset($input['code'])){
                $_message = "Sản phẩm với QR  code ".$input['code']." không có trong chương trình đổi điểm hoặc không phải là sản phẩm được sử dụng trong đợt này. Khách hàng vui lòng quét thêm sản phẩm khác.";
            }else{
                $_message = "Sản phẩm với QR  code không có trong chương trình đổi điểm hoặc không phải là sản phẩm được sử dụng trong đợt này. Khách hàng vui lòng quét thêm sản phẩm khác.";
            }
        }   
        return view('frontend2.qr-loyalty',compact('user','_message','_messages','_qrcode','product','_product','_qr_code_message'));
    }
}