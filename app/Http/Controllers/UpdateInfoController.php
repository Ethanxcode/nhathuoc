<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Auth;
use App\Repositories\UsersRepository;
use Flash;
use DB;
use Illuminate\Support\Facades\Hash;

use \App\Models\MedicineShop;
use App\Repositories\MedicineShopRepository;

class UpdateInfoController extends Controller
{

    /** @var  UsersRepository */
    private $usersRepository;

    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = DB::table('users')->where('id', Auth::user()->id)->get()->first();
        $nhathuoc = MedicineShop::get()->pluck('ten_nha_thuoc', 'id')->toArray();
        $nhathuoc[0] = 'Hãy chọn nhà thuốc';
        ksort($nhathuoc);
        // dd($nhathuoc[$user->nha_thuoc_id]);
        return view('frontend2.user.updateinfo', compact('user','nhathuoc'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        //

        
        
        $input = $request->all();
        
        $id = $input['user_id'];
        $user = Users::get()->where('id', $id);
        if (empty($user)) {
            Flash::error('Users not found');
            return redirect(route('users.index'));
        }
        
        $input['password'] = Hash::make($input['password']);

        $_user = $this->usersRepository->update($input, $id);
        $result['gt'] = 0;
        if($_user){
            $result['gt'] = 1;
        }
        echo json_encode($result);
    }
}