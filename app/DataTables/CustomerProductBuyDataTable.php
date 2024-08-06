<?php

namespace App\DataTables;

use App\Models\CustomerProductBuy;

/**
 * Class CustomerProductBuyDataTable
 */
class CustomerProductBuyDataTable
{
    /**
     * @return CustomerProductBuy
     */
    public function get()
    {
        /** @var CustomerProductBuy $query */
        $query = CustomerProductBuy::query()->select('customer_points.*');

        return $query;
    }
}
