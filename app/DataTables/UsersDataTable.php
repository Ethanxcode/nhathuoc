<?php

namespace App\DataTables;

use App\Models\Users;

/**
 * Class UsersDataTable
 */
class UsersDataTable
{
    /**
     * @return Users
     */
    public function get()
    {
        /** @var Users $query */
        $query = Users::query()->select('users.*');

        return $query;
    }
}
