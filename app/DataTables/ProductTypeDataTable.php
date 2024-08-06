<?php

namespace App\DataTables;

use App\Models\ProductType;

/**
 * Class ProductTypeDataTable
 */
class ProductTypeDataTable
{
    /**
     * @return ProductType
     */
    public function get()
    {
        /** @var ProductType $query */
        $query = ProductType::query()->select('product_types.*');

        return $query;
    }
}
