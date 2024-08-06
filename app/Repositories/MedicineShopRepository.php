<?php

namespace App\Repositories;

use App\Models\MedicineShop;
use App\Repositories\BaseRepository;

/**
 * Class MedicineShopRepository
 * @package App\Repositories
 * @version December 10, 2021, 2:52 am UTC
*/

class MedicineShopRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ten_nha_thuoc'
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
        return MedicineShop::class;
    }
}
