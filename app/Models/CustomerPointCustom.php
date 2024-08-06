<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CustomerPointCustom
 * @package App\Models
 * @version November 24, 2021, 6:06 pm UTC
 *
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $points
 */
class CustomerPointCustom extends Model
{

    public $table = 'customer_points';
    public $timestamps = false;
    

    public $fillable = [
        'user_id',
        'product_id',
        'points',
        'product_name'
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
        'points' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'product_id' => 'nullable',
        'points' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'client_name' => 'nullable'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['product_name','client_name'];

    /**
     * Get the customer_points product_name
     *
     * @param  string  $value
     * @return string
     */
    public function getProductNameAttribute($value)
    {
      return $this->attributes['product_name'];
    }

    /**
     * Get the customer_points client_name
     *
     * @param  string  $value
     * @return string
     */
    public function getClientNameAttribute($value)
    {
      return $this->attributes['client_name'];
    }

    
}