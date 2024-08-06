<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Product
 * @package App\Models
 * @version November 20, 2021, 5:46 am UTC
 *
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $qrcodes
 * @property string $product_name
 * @property string $sku
 * @property string $description
 * @property number $price
 * @property integer $qrcode_qty
 * @property integer $points
 * @property integer $user_id
 */
class Product extends Model
{
    use HasFactory;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_name',
        'sku',
        'description',
        'price',
        'qrcode_qty',
        'points',
        'client_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_name' => 'string',
        'sku' => 'string',
        'description' => 'string',
        'price' => 'decimal:2',
        'qrcode_qty' => 'integer',
        'points' => 'integer',
        'client_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_name' => 'required|string|max:255',
        'sku' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'price' => 'required|numeric',
        'qrcode_qty' => 'nullable',
        'points' => 'nullable',
        'client_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}