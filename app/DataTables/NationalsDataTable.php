<?php

namespace App\DataTables;

use App\Models\Nationals;

/**
 * Class NationalsDataTable
 */
class NationalsDataTable
{
    /**
     * @return Nationals
     */
    public function get()
    {
        /** @var Nationals $query */
        $query = Nationals::query()->select('nationals.*');

        return $query;
    }
}
