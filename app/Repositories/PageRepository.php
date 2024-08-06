<?php

namespace App\Repositories;

use App\Models\Page;
use App\Repositories\BaseRepository;

/**
 * Class PageRepository
 * @package App\Repositories
 * @version November 19, 2021, 5:19 pm UTC
*/

class PageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'content',
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
        return Page::class;
    }
}
