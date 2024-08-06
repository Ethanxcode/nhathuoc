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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Login Routes

Route::get('/admin/login', [App\Http\Controllers\Backend\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login/submit', [App\Http\Controllers\Backend\Auth\LoginController::class,'login'])->name('admin.login.submit');


Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin.dashboard');
    

    Route::resource('dashboard', App\Http\Controllers\Backend\DashboardController::class);
    
    Route::resource('users', App\Http\Controllers\Backend\UsersController::class);
    Route::resource('admins', App\Http\Controllers\Backend\AdminController::class);
    Route::resource('pages', App\Http\Controllers\Backend\PageController::class);
    Route::resource('products', App\Http\Controllers\Backend\ProductController::class);
    Route::resource('qrcodes', App\Http\Controllers\Backend\QrcodeController::class);
    Route::get('giftTypes/import', [App\Http\Controllers\Backend\GiftTypeController::class, 'import'])->name('gifttypes.import');
    Route::resource('giftTypes', App\Http\Controllers\Backend\GiftTypeController::class);
    Route::get('gifts/import',[App\Http\Controllers\Backend\GiftController::class, 'import'])->name('gifts.import');
    Route::resource('gifts', App\Http\Controllers\Backend\GiftController::class);

    Route::resource('customerGifts', App\Http\Controllers\Backend\CustomerGiftController::class);
    
    Route::resource('customerPoints', App\Http\Controllers\Backend\CustomerPointController::class);

    Route::resource('customerClientPoints', App\Http\Controllers\Backend\CustomerClientPointController::class);
    
    // Logout Routes
    Route::post('/logout/submit', [App\Http\Controllers\Backend\Auth\LoginController::class, 'logout'])->name('admin.logout.submit');


    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgotPasswordController@reset')->name('admin.password.update');

    Route::get('/generateQrCode', [App\Http\Controllers\Backend\QrcodeController::class, 'generateQrCode'])->name('generate.qrcode');

    Route::resource('medicineShops', App\Http\Controllers\Backend\MedicineShopController::class);
});