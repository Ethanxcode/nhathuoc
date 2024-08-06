<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CustomerGift
 * @package App\Models
 * @version November 24, 2021, 1:13 pm UTC
 *
 * @property integer $user_id
 * @property integer $urbox_id
 * @property string $cart_detail_id
 * @property string $code_display
 * @property string $code
 * @property string $link
 * @property string $code_image
 * @property string $gift_value
 * @property string $expired
 * @property string $transaction
 * @property string edition_params
 */
class CustomerGift extends Model
{

    use HasFactory;

    public $table = 'customer_gifts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'urbox_id',
        'cart_detail_id',
        'code_display',
        'code',
        'link',
        'code_image',
        'gift_value',
        'expired',
        'transaction',
        'edition_params',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'urbox_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'urbox_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}