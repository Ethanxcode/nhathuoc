<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/account', function () {
//     return view('account');
// });

// Route::get('/qrcode', function () {
//     return view('qrcode');
// });

// Route::get('/huong-dan-tich-doi-diem', [App\Http\Controllers\PageGuideController::class, 'index'])->name('huong-dan-tich-doi-diem');
// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'perform'])->name('login');


// Route::group(['middleware' => ['auth:web']], function() {

//     Route::get('/points', [App\Http\Controllers\CustomerPointsController::class, 'index'])->name('points');
//     Route::get('/gifts', [App\Http\Controllers\GiftController::class, 'index'])->name('gifts');
//     Route::get('/info', [App\Http\Controllers\UpdateInfoController::class, 'index'])->name('info');

//     Route::get('/productbuy', [App\Http\Controllers\CustomerProductController::class, 'index'])->name('productbuy');
//     Route::patch('/info/{id}',[
//         'as' => 'info.update',
//         'uses' => 'App\Http\Controllers\UpdateInfoController@update'
//     ]);

//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::get('/qrcode-loyalty', [App\Http\Controllers\QrLoyaltyController::class, 'index'])->name('qrcode-loyalty');
//     Route::post('/change-gift', [App\Http\Controllers\ChangeGiftController::class, 'store'])->name('gift.change');
    
//     Route::get('/logout', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');

//     Route::get('/', function () {
//         return view('welcome');
//     });
//  });
// Auth::routes();


Route::get('/account', function () {
    return view('frontend2.account');
});

Route::get('/qrcode', function () {
    return view('qrcode');
});

Route::get('/huong-dan-tich-doi-diem', [App\Http\Controllers\PageGuideController::class, 'index'])->name('huong-dan-tich-doi-diem');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'perform'])->name('login');
Route::get('/uregister', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('uregister');

Route::group(['middleware' => ['auth:web']], function() {

    Route::get('/points', [App\Http\Controllers\CustomerPointsController::class, 'index'])->name('points');
    Route::get('/points/{id}', [App\Http\Controllers\CustomerPointsController::class, 'detail'])->name('points.detail');
    Route::get('/gifts', [App\Http\Controllers\GiftController::class, 'index'])->name('gifts');
    Route::get('/info', [App\Http\Controllers\UpdateInfoController::class, 'index'])->name('info');

    Route::get('/productbuy', [App\Http\Controllers\CustomerProductController::class, 'index'])->name('productbuy');
    // Route::patch('/info/{id}',[
    //     'as' => 'info.update',
    //     'uses' => 'App\Http\Controllers\UpdateInfoController@update'
    // ]);

    Route::post('/info',[
        'as' => 'info.update',
        'uses' => 'App\Http\Controllers\UpdateInfoController@update'
    ]);


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/qrcode-loyalty', [App\Http\Controllers\QrLoyaltyController::class, 'index'])->name('qrcode-loyalty');
    Route::post('/change-gift', [App\Http\Controllers\ChangeGiftController::class, 'store'])->name('gift.change');
    
    Route::get('/logout', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');

    Route::get('/', function () {
        return view('frontend2.welcome');
    });
 });
Auth::routes();
