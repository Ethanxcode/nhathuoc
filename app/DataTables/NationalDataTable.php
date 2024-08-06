<?php

namespace App\DataTables;

use App\Models\National;

/**
 * Class NationalDataTable
 */
class NationalDataTable
{
    /**
     * @return National
     */
    public function get()
    {
        /** @var National $query */
        $query = National::query()->select('nationals.*');

        return $query;
    }
}
