<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Qrcode
 * @package App\Models
 * @version November 20, 2021, 6:08 am UTC
 *
 * @property \App\Models\Product $product
 * @property string $qr_code
 * @property string $image
 * @property integer $product_id
 * @property string|\Carbon\Carbon $begined_at
 * @property string|\Carbon\Carbon $ended_at
 * @property string $status
 */
class Qrcode extends Model
{

    use HasFactory;

    public $table = 'qrcodes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'qr_code',
        'image',
        'product_id',
        'begined_at',
        'ended_at',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qr_code' => 'string',
        'image' => 'string',
        'product_id' => 'integer',
        'begined_at' => 'datetime',
        'ended_at' => 'datetime',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'qr_code' => 'required|string|max:255',
        'image' => 'required|string|max:255',
        'product_id' => 'required',
        'begined_at' => 'nullable',
        'ended_at' => 'nullable',
        'status' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}