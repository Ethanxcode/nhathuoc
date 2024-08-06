<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$user = Users::get()->where('id',Auth::user()->id)->first();

        $user = Users::query()
        ->select('users.*', 'nhathuoc.ten_nha_thuoc')
        ->leftJoin('nhathuoc', 'users.nha_thuoc_id', '=', 'nhathuoc.id')
        ->where('users.id', Auth::user()->id)->get()->first();

      
        return view('frontend2.home',compact('user'));
    }
}