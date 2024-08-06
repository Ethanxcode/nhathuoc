<?php

namespace App\Repositories;

use App\Models\GiftType;
use App\Repositories\BaseRepository;

/**
 * Class GiftTypeRepository
 * @package App\Repositories
 * @version November 20, 2021, 7:26 am UTC
*/

class GiftTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return GiftType::class;
    }
}
