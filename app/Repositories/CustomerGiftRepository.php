<?php

namespace App\Repositories;

use App\Models\CustomerGift;
use App\Repositories\BaseRepository;

/**
 * Class CustomerGiftRepository
 * @package App\Repositories
 * @version November 24, 2021, 1:13 pm UTC
*/

class CustomerGiftRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'gift_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CustomerGift::class;
    }
}
