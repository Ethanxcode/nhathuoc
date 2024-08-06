<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CustomerClientPoint
 * @package App\Models
 * @version November 28, 2021, 1:14 am UTC
 *
 * @property integer $user_id
 * @property integer $client_id
 * @property integer $total_points
 * @property integer $total_points_used
 */
class CustomerClientPoint extends Model
{

    use HasFactory;

    public $table = 'customer_client_point';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'client_id',
        'total_points',
        ''
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'client_id' => 'integer',
        'total_points' => 'integer',
        'total_points_used' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'client_id' => 'required',
        'total_points' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}