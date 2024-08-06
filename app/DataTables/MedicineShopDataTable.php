<?php

namespace App\DataTables;

use App\Models\MedicineShop;

/**
 * Class MedicineShopDataTable
 */
class MedicineShopDataTable
{
    /**
     * @return MedicineShop
     */
    public function get()
    {
        /** @var MedicineShop $query */
        $query = MedicineShop::query()->select('nhathuoc.*');

        return $query;
    }
}
