<?php

namespace App\Repositories;

use App\Models\Qrcode;
use App\Repositories\BaseRepository;

/**
 * Class QrcodeRepository
 * @package App\Repositories
 * @version November 20, 2021, 6:08 am UTC
*/

class QrcodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qr_code',
        'image',
        'product_id',
        'begined_at',
        'ended_at',
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
        return Qrcode::class;
    }
}
