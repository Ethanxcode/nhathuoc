<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QrLoyaltyRequest extends FormRequest
{

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'code' => 'required|string',
      'productCode' => 'required|string',
      'campaignId' => 'required|string',
      'productName' => 'required|string',
      'vendorId' => 'required|string',
      'checksum' => 'required|string',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes()
  {
    return [
      'code' => 'Code',
      'productCode' => 'Product Code',
      'campaignId' => 'Campaign Id',
      'productName' => 'Product Name',
      'vendorId' => 'Vendor Id',
      'checksum' => 'Check Sum'
    ];
  }
}