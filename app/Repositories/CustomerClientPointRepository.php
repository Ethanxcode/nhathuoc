<?php

namespace App\Repositories;

use App\Models\CustomerClientPoint;
use App\Repositories\BaseRepository;

/**
 * Class CustomerClientPointRepository
 * @package App\Repositories
 * @version November 28, 2021, 1:14 am UTC
*/

class CustomerClientPointRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'client_id',
        'total_points'
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
        return CustomerClientPoint::class;
    }
}
