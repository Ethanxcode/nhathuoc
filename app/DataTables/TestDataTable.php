<?php

namespace App\DataTables;

use App\Models\Test;

/**
 * Class TestDataTable
 */
class TestDataTable
{
    /**
     * @return Test
     */
    public function get()
    {
        /** @var Test $query */
        $query = Test::query()->select('test.*');

        return $query;
    }
}
