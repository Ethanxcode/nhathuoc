<?php

namespace App\DataTables;

use App\Models\Ads;

/**
 * Class AdsDataTable
 */
class AdsDataTable
{
    /**
     * @return Ads
     */
    public function get()
    {
        /** @var Ads $query */
        $query = Ads::query()->select('ads.*');

        return $query;
    }
}
