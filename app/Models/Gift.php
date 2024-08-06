<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Gift
 * @package App\Models
 * @version November 20, 2021, 7:27 am UTC
 *
 * @property \App\Models\GiftType $giftType
 * @property \App\Models\User $user
 * @property string $name
 * @property string $value
 * @property integer $gift_type
 * @property integer $user_id
 * @property string $content
 * @property string $note
 * @property string $office
 * @property string $status
 */
class Gift extends Model
{

    use HasFactory;

    public $table = 'gifts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'value',
        'gift_type',
        'client_id',
        'content',
        'note',
        'office',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'value' => 'string',
        'gift_type' => 'integer',
        'client_id' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'value' => 'required|string|max:255',
        'gift_type' => 'required',
        'client_id' => 'required',
        'status' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function giftType()
    {
        return $this->belongsTo(\App\Models\GiftType::class, 'gift_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}