<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\CustomerPointDataTable;
use DataTables;
use DB;
use App\Models\CustomerClientPoint;
use App\Models\CustomerPoint;
use App\Models\Gift;
use Auth;
use App\Models\Users;

class CustomerPointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     return Datatables::of((new CustomerPointDataTable())->getPointProduct())->make(true);
        // }
        $query_points = CustomerClientPoint::where('user_id', Auth::user()->id)->get();    
        $points = array();
        foreach($query_points as $item){
            $points[$item->client_id]['total_point'] = $item->total_points;    
            $points[$item->client_id]['total_points_used'] = $item->total_points_used;    
        }

        //dd($points);


        $_gift = CustomerPoint::query()
         ->select('admins.id as client_id','user_id', 'customer_points.id', 'product_name', 'admins.name as client_name','gifts.title as gift_name', 'gift_types.name as gift_type_name','gifts.price as gt', 'customer_points.points as cpoints', 'gifts.image as image','gifts.urbox_id as urbox_id','gifts.quantity')
         ->join('products', 'customer_points.product_id', '=', 'products.id')
         ->join('admins', 'admins.id', '=', 'products.client_id')
         ->join('gifts', 'gifts.client_id', '=', 'admins.id')
         ->join('gift_types', 'gift_types.urbox_type_id', '=', 'gifts.urbox_type_id')
         ->where('customer_points.user_id', Auth::user()->id)
         ->groupBy('gifts.urbox_id')->paginate(15);
         
        $gifts = array();
        foreach($_gift as $item){
            $gifts[$item->client_id]['label'] = $item->client_name;
            $gifts[$item->client_id]['data'][] = $item;
        }

        $customer = Users::where('id', Auth::user()->id)->get()->first();
        return view('frontend2.customerpoints', compact('points','gifts','_gift','customer'));
    }

    public function detail($id){

        $total_point = 0;
        $msg = '';
        $gift  = Gift::where('urbox_id', $id)->get()->first();
        
        if(empty($gift)){
            $msg = 'Quà này không tìm thấy.';
        }else{
            
            $points = CustomerClientPoint::where([['user_id', '=', Auth::user()->id],['client_id','=', $gift->client_id]])->get()->first();    
            
            if(empty($points) == false){
                $total_point  = $points->total_points;   
            }
            
        }
        
        
        return view('frontend2.gift-detail', compact('gift','msg','total_point'));
    }
}