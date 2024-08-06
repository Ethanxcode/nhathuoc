<?php

namespace App\DataTables;

use App\Models\CustomerClientPoint;

/**
 * Class CustomerClientPointDataTable
 */
class CustomerClientPointDataTable
{
    /**
     * @return CustomerClientPoint
     */
    public function get()
    {
        /** @var CustomerClientPoint $query */
        $query = CustomerClientPoint::query()->select('customer_client_point.*');

        return $query;
    }
}
