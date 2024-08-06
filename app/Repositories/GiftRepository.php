<?php

namespace App\Repositories;

use App\Models\Gift;
use App\Repositories\BaseRepository;

/**
 * Class GiftRepository
 * @package App\Repositories
 * @version November 20, 2021, 7:27 am UTC
*/

class GiftRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'value',
        'gift_type',
        'user_id',
        'status'
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
        return Gift::class;
    }
}
