<?php

namespace App\Repositories;

use App\Models\CustomerPoint;
use App\Repositories\BaseRepository;

/**
 * Class CustomerPointRepository
 * @package App\Repositories
 * @version November 24, 2021, 6:06 pm UTC
*/

class CustomerPointRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'product_id',
        'points'
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
        return CustomerPoint::class;
    }
}
