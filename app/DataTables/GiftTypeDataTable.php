<?php

namespace App\DataTables;

use App\Models\GiftType;

/**
 * Class GiftTypeDataTable
 */
class GiftTypeDataTable
{
    /**
     * @return GiftType
     */
    public function get()
    {
        /** @var GiftType $query */
        $query = GiftType::query()->select('gift_types.*');

        return $query;
    }
}
