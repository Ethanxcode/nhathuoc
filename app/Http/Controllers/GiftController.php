<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPoint;
use App\Models\CustomerGift;
use App\Models\CustomerClientPoint;
use DB;
use Auth;

class GiftController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $_gift = CustomerPoint::query()
         ->select('admins.id as client_id','user_id', 'customer_points.id', 'product_name', 'admins.name as client_name','gifts.title as gift_name', 'gifts.urbox_id', 'gift_types.name as gift_type_name','gifts.price as gt', 'customer_points.points as cpoints', 'gifts.image as image','gifts.urbox_id as urbox_id','gifts.quantity')
         ->join('products', 'customer_points.product_id', '=', 'products.id')
         ->join('admins', 'admins.id', '=', 'products.client_id')
         ->join('gifts', 'gifts.client_id', '=', 'admins.id')
         ->join('gift_types', 'gift_types.urbox_type_id', '=', 'gifts.urbox_type_id')
         ->where('customer_points.user_id', Auth::user()->id)
         ->groupBy('urbox_id')->get();

        $my_gift = CustomerGift::query()
         ->select('customer_gifts.id', 'gifts.title as gift_name', 'gifts.id as gift_id', 'gift_types.name as gift_type_name','gifts.price as gt', 'customer_gifts.gift_value as gift', 'customer_gifts.code as gift_code', 'customer_gifts.code_image as gift_code_image', 'customer_gifts.link as gift_code_link', 'gifts.image as image')
         ->join('gifts', 'gifts.urbox_id', '=', 'customer_gifts.urbox_id')
         ->join('gift_types', 'gift_types.urbox_type_id', '=', 'gifts.urbox_type_id')
         ->where('customer_gifts.user_id', Auth::user()->id)->paginate(10);

        //  $my_gift = CustomerGift::query()
        //  ->select('customer_gifts.id', 'gifts.title as gift_name', 'gifts.id as gift_id', 'gift_types.name as gift_type_name','gifts.price as gt', 'customer_gifts.gift_value as gift', 'customer_gifts.code as gift_code', 'customer_gifts.code_image as gift_code_image', 'customer_gifts.link as gift_code_link', 'gifts.image as image')
        //  ->join('gifts', 'gifts.urbox_id', '=', 'customer_gifts.urbox_id')
        //  ->join('gift_types', 'gift_types.urbox_type_id', '=', 'gifts.urbox_type_id')
        //  ->where('customer_gifts.user_id', Auth::user()->id)->get();

        // $query_points =  CustomerPoint::query()
        // ->selectRaw('SUM(customer_points.points) AS points, products.client_id as client_id')
        // ->join('products', 'customer_points.product_id', '=', 'products.id')
        // ->where('customer_points.user_id', Auth::user()->id)
        // ->groupBy('client_id')->get();

        $query_points = CustomerClientPoint::where('user_id', Auth::user()->id)->get();
        

        $points = array();
        foreach($query_points as $item){
            $points[$item->client_id] = $item->total_points;    
        }

        //dd($query_points);
                
        $gifts = array();
        foreach($_gift as $item){
            $gifts[$item->client_id]['label'] = $item->client_name;
            $gifts[$item->client_id]['data'][] = $item;
        }

        
 
        return view('frontend2.gifts', compact('gifts', 'my_gift', 'points','_gift'));
    }
}