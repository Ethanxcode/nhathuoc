<?php

namespace App\DataTables;

use App\Models\FactoryInfo;

/**
 * Class FactoryInfoDataTable
 */
class FactoryInfoDataTable
{
    /**
     * @return FactoryInfo
     */
    public function get()
    {
        /** @var FactoryInfo $query */
        $query = FactoryInfo::query()->select('factory_info.*');

        return $query;
    }
}
