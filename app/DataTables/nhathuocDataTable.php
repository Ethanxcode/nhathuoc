<?php

namespace App\DataTables;

use App\Models\nhathuoc;

/**
 * Class nhathuocDataTable
 */
class nhathuocDataTable
{
    /**
     * @return nhathuoc
     */
    public function get()
    {
        /** @var nhathuoc $query */
        $query = nhathuoc::query()->select('nhathuoc.*');

        return $query;
    }
}
