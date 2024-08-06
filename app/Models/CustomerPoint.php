<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CustomerPoint
 * @package App\Models
 * @version November 24, 2021, 6:06 pm UTC
 *
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $points
 */
class CustomerPoint extends Model
{

    use HasFactory;

    public $table = 'customer_points';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'product_id',
        'points'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'product_id' => 'integer',
        'points' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'product_id' => 'required',
        'points' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}