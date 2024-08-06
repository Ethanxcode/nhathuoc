<?php

namespace App\DataTables;

use App\Models\CustomerPoint;
use App\Models\CustomerPointCustom;
use DB;
use Auth;

/**
 * Class CustomerPointDataTable
 */
class CustomerPointDataTable
{
    /**
     * @return CustomerPoint
     */
    public function get()
    {
        /** @var CustomerPoint $query */
        $query = CustomerPoint::query()->select('customer_points.*');

        return $query;
    }

    /**
     * @return CustomerPointCustom
     */
    public function getPointProduct()
    {
        // /** @var CustomerPoint $query */
        $query = CustomerPoint::query()
        ->join('products', 'customer_points.product_id', '=', 'products.id')
        ->select('customer_points.id','user_id', 'product_id', 'product_name', 'customer_points.points')
        ->where('customer_points.user_id' , Auth::user()->id);

        return $query;
    }


    /**
     * @return CustomerPointCustom
     */
    public function getCustomerProduct()
    {

        //$query = DB::table('customer_points')
        $query = CustomerPoint::query()
         ->selectRaw('COUNT(products.id) AS sl, SUM(products.points) AS point_of_product,user_id, customer_points.id, products.id as pid, product_name, name as client_name')
         ->join('products', 'customer_points.product_id', '=', 'products.id')
         ->join('admins', 'admins.id', '=', 'products.client_id')
         ->where('customer_points.user_id', Auth::user()->id)
        //  ->select('customer_points.id', 'products.id as pid', 'product_name', 'name as client_name', 'COUNT(products.id) AS sl', 'SUM(customer_points.points) AS points')
        
        
        //  , 'COUNT(p.id) AS sl', 'SUM(cm.points) AS points'
        // ->where('p.user_id', Auth::user()->id)
        //  ->where('status',0)
         ->groupBy('pid');

        

        // $query = DB::select('select p.id, product_name,name as client_name, sum(cm.points) as points, count(p.id) as sl from customer_points cm 
        // join products p on cm.product_id = p.id 
        // join admins a on a.id = p.client_id
        // group by p.id');
        // dd($query);
        return $query;
    }
}