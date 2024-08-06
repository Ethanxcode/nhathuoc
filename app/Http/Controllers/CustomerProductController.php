<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\CustomerPointDataTable;
use DataTables;
use DB;
use App\Models\CustomerClientPoint;
use App\Models\Admin;
use Auth;

class CustomerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(Datatables::of((new CustomerPointDataTable())->getCustomerProduct())->make(true));
        if ($request->ajax()) {
            return Datatables::of((new CustomerPointDataTable())->getCustomerProduct())->make(true);
        }

        $query_points = CustomerClientPoint::where('user_id', Auth::user()->id)->get();    
        $points = array();
        $i = 0;
        foreach($query_points as $item){
            $points[$i]['total_points'] = $item->total_points;   
            $points[$i]['client_id'] = $item->client_id;    
            $i++;
        }  
        
        //dd($points);
        

        $clients = Admin::all()->pluck('name','id')->toArray();
        return view('frontend2.customerproduct', compact('points', 'clients'));
    }
}