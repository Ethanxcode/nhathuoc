<?php

namespace App\DataTables;

use App\Models\CustomerGift;

/**
 * Class CustomerGiftDataTable
 */
class CustomerGiftDataTable
{
    /**
     * @return CustomerGift
     */
    public function get()
    {
        /** @var CustomerGift $query */
        $query = CustomerGift::query()->select('customer_gifts.*');

        return $query;
    }
}
