<?php

namespace App\Libs;
use App;

class Urbox
{
  private $private_key;

  private $cat_id = array(
    4 => 'Mua sắm',
    5 => 'Làm đẹp - Sức khoẻ',
    6 => 'Giải trí',
    8 => 'Đồ ăn',
    9 => 'Thức uống',
    101 => 'Mua sắm',
    107 => 'Tiện ích'
  );
  private $city_id = array(
    22 => 'Hà Nôi',
    29 => 'Hồ Chí Minh'
  );
  private $urbox_url;
  private $urbox_body;


public function __construct(){
  $this->urbox_url = env('URBOX_URL');
  //dd(App::environment('URBOX_URL'));
  
  $this->urbox_body = array(
    'app_id' => env('URBOX_APP_ID'),
    'app_secret' => env('URBOX_APP_SECRET')
  );

  $this->private_key = file_get_contents(__DIR__ . '/privatekey');
}

public function getCityId() {
  return $this->city_id;
}

public function getCatId() {
  return $this->cat_id;
}
// Lấy quà tặng từ kho quà UrBox
public function getGiftLists($city_id, $branch_id, $title = '', $per_page = 0, $page_no = 0, $lang = 'vi') {
  $params = $this->urbox_body;
  if(empty($branch_id) == false){
    $params['brand_id'] = $branch_id;
  }
  if(empty($city_id) == false){
    $params['city_id'] = $city_id;
  }
  $params['field'] = 'content,note,office';
  $params['lang'] = empty($lang) ? 'vi' : $lang;
  $params['stock'] = 1;
  if (empty($title) == false) {
    $params['title'] = $title;
  }
  if (empty($per_page) == false) {
    $params['per_page'] = $per_page;
  }
  if (empty($page_no) == false) {
    $params['page_no'] = $page_no;
  }
  $header = array(
      'Content-Type: application/json'
    );
  if(env('APP_ENV') != 'production'){
    $header[] = 'authorization: Basic dXJib3g6dXJib3hAMTcwKio=';
  }
  return $this->execUrl('/4.0/gift/lists', 'GET', $params, null, $header);
}
// Lấy thông tin chi tiết quà tặng
public function getGiftDetail($gitf_id, $lang = 'vi') {
  $params = $this->urbox_body;
  $params['id'] = $id;
  $params['lang'] = $lang;
  return $this->execUrl('/4.0/gift/detail', 'GET', $params);
}

// Lấy danh sách danh mục
public function getCategory($parent_id = 0, $lang = 'vi') {
  $params = $this->urbox_body;
  if (empty($parent_id) == false) {
    $params['parent_id'] = $parent_id;
  }
  return $this->execUrl('/2.0/category/catbyparent', 'GET', $params);
}

// Lấy danh sách thương hiệu
public function getBrand($cat_id, $lang = 'vi') {
  $params = $this->urbox_body;
  $params['cat_id'] = $cat_id;
  return $this->execUrl('/4.0/gift/brand', 'GET', $params);
}

// Tra cứu theo mã user và thời gian
public function getCardList($params = array()) {
  $params['app_id'] = $this->urbox_body['app_id'];
  $params['app_secret'] = $this->urbox_body['app_secret'];
  return $this->execUrl('/2.0/cart/getlist', 'GET', $params, array(
    'Content-Type: application/json'
  ));
}

// Tra cứu theo chi tiết đơn hàng
public function getCardDetail($transaction_id, $cart_id = '') {
  $params = $this->urbox_body;
  $params['transaction_id'] = $transaction_id;
  if (empty($cart_id) == false) {
    $params['cart_id'] = $cart_id;
  }
  return $this->execUrl('/2.0/cart/getByTransaction', 'GET', $params, array(
    'Content-Type: application/json'
  ));
}

// Tạo yêu cầu đổi quà tới UrBox - Quà vật lý VÀ Quà eVoucher
public function cartPayVoucher($params = array()) {
  $params['app_id'] = $this->urbox_body['app_id'];
  $params['app_secret'] = $this->urbox_body['app_secret'];
  return $this->execUrl('/2.0/cart/cartPayVoucher', 'POST', $params, array(
    'Content-Type: application/json',
    'Signature: ' . $this->getSignature($params)
  ));
}

private function getSignature($data) {
  unset($data['ttphone']);
  ksort($data);
  
  $data = json_encode($data);
  
  //openssl_sign($data, $signature, $this->private_key, OPENSSL_ALGO_SHA256);
  $signature = '';

  openssl_sign($data, $signature, $this->private_key, OPENSSL_ALGO_SHA256);
  return base64_encode($signature);
}

// athu = 'authorization: Basic dXJib3g6dXJib3hAMTcwKio='
public function importGift(){
  
  return $this->getGiftLists(0, 0, '');//$this->execUrl('/4.0/gift/lists', 'GET', $params, $header);
}

private function execUrl($path, $method, $body = array(), $header = array('Content-Type: application/json')) {
  
  $curl = curl_init();
  $opt_info = array(
    CURLOPT_URL => $this->urbox_url . $path,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 2000, // 2s
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method,
  );

  if (empty($body) == false) {
    $opt_info[CURLOPT_POSTFIELDS] = json_encode($body);
  }
  if (empty($header) == false) {
    $opt_info[CURLOPT_HTTPHEADER] = $header;
  }
  // var_dump($opt_info);
  curl_setopt_array($curl, $opt_info);

  $response = curl_exec($curl);
  //dd($response);
  
  curl_close($curl);
  $decode = @json_decode($response);
  
  
  if (empty($decode)) {
    return $response;
  }
  return $decode;
}

public function uuidv4() {
  return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

    // 32 bits for "time_low"
    mt_rand(0, 0xffff), mt_rand(0, 0xffff),

    // 16 bits for "time_mid"
    mt_rand(0, 0xffff),

    // 16 bits for "time_hi_and_version",
    // four most significant bits holds version number 4
    mt_rand(0, 0x0fff) | 0x4000,

    // 16 bits, 8 bits for "clk_seq_hi_res",
    // 8 bits for "clk_seq_low",
    // two most significant bits holds zero and one for variant DCE1.1
    mt_rand(0, 0x3fff) | 0x8000,

    // 48 bits for "node"
    mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
  );
}

}