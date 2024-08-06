<?php

namespace App\DataTables;

use App\Models\Provinces;

/**
 * Class ProvincesDataTable
 */
class ProvincesDataTable
{
    /**
     * @return Provinces
     */
    public function get()
    {
        /** @var Provinces $query */
        $query = Provinces::query()->select('provinces.*');

        return $query;
    }
}
