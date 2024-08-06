<?php

namespace App\DataTables;

use App\Models\Factory;

/**
 * Class FactoryDataTable
 */
class FactoryDataTable
{
    /**
     * @return Factory
     */
    public function get()
    {
        /** @var Factory $query */
        $query = Factory::query()->select('factories.*');

        return $query;
    }
}
