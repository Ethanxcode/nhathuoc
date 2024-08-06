<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \App\Models\MedicineShop;
use App\Repositories\MedicineShopRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MedicineShopRepository $medicineShopRepository)
    {
        $this->medicineShopRepository = $medicineShopRepository;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'min:10', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $nhathuoc = '';
        if($data['ten_nha_thuoc']!=''){
            $nhathuoc = MedicineShop::where('ten_nha_thuoc','like','%'.$data['ten_nha_thuoc'].'%')->get()->first();
            
            if(!$nhathuoc){
                $_data = array();
                $_data['ten_nha_thuoc'] = $data['ten_nha_thuoc'];
                $nhathuoc = $this->medicineShopRepository->create($_data);
            }
        }

        $nhathuoc_id  = $nhathuoc->id;
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'nha_thuoc_id' => $nhathuoc_id,
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ]);
    }

    public function index()
    {
        $nhathuoc = array();
        $nhathuoc = MedicineShop::get()->pluck('ten_nha_thuoc', 'id')->toArray();
        if(!empty($nhathuoc)){
            $nhathuoc[0] = 'Hãy chọn nhà thuốc';
        }else{
            $nhathuoc[] = 'Hãy chọn nhà thuốc';
        }
        ksort($nhathuoc);
        
        return view('auth.register', compact('nhathuoc'));
    }

}