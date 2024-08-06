<?php

namespace App\DataTables;

use App\Models\Gift;

/**
 * Class GiftDataTable
 */
class GiftDataTable
{
    /**
     * @return Gift
     */
    public function get()
    {
        /** @var Gift $query */
        $query = Gift::query()->select('gifts.*');

        return $query;
    }
}
