<?php

namespace App\DataTables;

use App\Models\Admin;

/**
 * Class AdminDataTable
 */
class AdminDataTable
{
    /**
     * @return Admin
     */
    public function get()
    {
        /** @var Admin $query */
        $query = Admin::query()->select('admins.*');

        return $query;
    }
}
