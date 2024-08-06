<?php

namespace App\DataTables;

use App\Models\IndustrialArea;

/**
 * Class IndustrialAreaDataTable
 */
class IndustrialAreaDataTable
{
    /**
     * @return IndustrialArea
     */
    public function get()
    {
        /** @var IndustrialArea $query */
        $query = IndustrialArea::query()->select('industrial_areas.*');

        return $query;
    }
}
