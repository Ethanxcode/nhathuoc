<?php

namespace App\DataTables;

use App\Models\Resources;

/**
 * Class ResourcesDataTable
 */
class ResourcesDataTable
{
    /**
     * @return Resources
     */
    public function get()
    {
        /** @var Resources $query */
        $query = Resources::query()->select('resources.*');

        return $query;
    }
}
