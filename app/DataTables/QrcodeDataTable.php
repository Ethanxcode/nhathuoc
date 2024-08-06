<?php

namespace App\DataTables;

use App\Models\Qrcode;

/**
 * Class QrcodeDataTable
 */
class QrcodeDataTable
{
    /**
     * @return Qrcode
     */
    public function get()
    {
        /** @var Qrcode $query */
        $query = Qrcode::query()->select('qrcodes.*');

        return $query;
    }
}
