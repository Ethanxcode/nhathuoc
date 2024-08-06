<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gift;
use App\Models\CustomerPoint;
use App\Models\CustomerClientPoint;
use App\Models\CustomerGift;
use Auth;
use App\Libs\Urbox;

class ChangeGiftController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //$query_points =  CustomerClientPoint::get()->where('user_id',Auth::user()->id);
    
        // $points = array();
        // foreach($query_points as $item){
        //     $points[$item->client_id] = $item->total_points;
        // }

        $input = $request->all();
        $gift_id =  $input['gift_id'];

        $gift = Gift::get()->where('urbox_id', $gift_id)->first();

       
        // $gift = Gift::get()->where('urbox_id', 4669)->first();
        $client_id = $gift->client_id;
        // echo json_encode($gift);
        // exit;    
        //['user_id' =>  Auth::user()->id, 'client_id' => $product->client_id]    
        $customer_client_point =  CustomerClientPoint::where(['user_id' =>  Auth::user()->id, 'client_id' => $client_id])->get()->first();
        $point = $customer_client_point->total_points;
        
        $total = $point * 1000;
        $result = array();
        if($total < $gift->price){
            $result['gt'] = 0;
            $result['message'] = 'Điểm của bạn không đủ để đổi quà này. Hãy chọn quà khác.';
            echo json_encode($result);
            exit;
        }

        $urboxObj = new Urbox();
        
        $_customer_gift_data = array();
        //$_customer_gift_data['user_id'] = Auth::user()->id;
        //$_customer_gift_data['urbox_id'] = $gift->urbox_id;
        $_customer_gift_data['transaction'] = $urboxObj->uuidv4();
        

        //$_customer_gift_data['user_id'] = Auth::user()->id;
        //$_customer_gift_data['urbox_id'] = $gift->urbox_id;
        //$customer_gift = CustomerGift::create($_customer_gift_data);
        //dd( $customer_gift);
        // create urbox object
        $response = $urboxObj->cartPayVoucher(array(
            "site_user_id" => '' . Auth::user()->id,
            "transaction_id" => $_customer_gift_data['transaction'],
            "ttphone" => Auth::user()->phone,
            "dataBuy" => [
                  [
                      "priceId" => $gift->urbox_id,
                      "quantity" => 1,
                      "amount" =>  $gift->price
                  ]
              ],
              "isSendSms" => 0
        ));
        
        $gift_value = '';
        //$_customer_gift_data['user_id'] = Auth::user()->id;
        //$_customer_gift_data['urbox_id'] = $gift->urbox_id;
        //$customer_gift = CustomerGift::create($_customer_gift_data);
        //$customer_gift->gift_value = $gift_value;
        //$customer_gift->save();

        if(empty($response) == false){  
            //dd($response);
            if($response->status == 200){
                $_customer_gift_data['user_id'] = Auth::user()->id;
                $_customer_gift_data['urbox_id'] = $gift->urbox_id;
                $customer_gift = CustomerGift::create($_customer_gift_data);
                $customer_gift->gift_value = $gift_value;
                $customer_gift->save();

                $data = $response->data;
                
                $edition_params = json_encode($data->cart);
                $gift_link = $data->cart->code_link_gift[0];
                $customer_gift->cart_detail_id = $gift_link->cart_detail_id;
                $customer_gift->code_display = $gift_link->code_display;
                $customer_gift->link = $gift_link->link;
                $customer_gift->code = $gift_link->code;
                $customer_gift->expired = $gift_link->expired;
                $customer_gift->code_image = $gift_link->code_image;
                $customer_gift->edition_params = $edition_params;
                $customer_gift->save();

                $_point_buy = $gift->price / 1000;
                $_point = $customer_client_point->total_points - $_point_buy;

                $customer_client_point->total_points = $_point;
                $customer_client_point->total_points_used += $_point_buy;
                $customer_client_point->save();
                $result['gt'] = 1;
                $result['message'] = 'Bạn đã đổi quà thàng công. Hãy vào danh sách quà của bạn để xem.';
                
            }else{
                
                $result['gt'] = 0;
                $result['message'] = 'Bạn đã đổi quà không thàng công. '.$response->msg;
            }
        }else{
            dd($response);
            $result['gt'] = 0;
            $result['message'] = 'Bạn đã đổi quà không thàng công. Hãy thử lại.';
        }
        
        echo json_encode($result);
    }
    
}