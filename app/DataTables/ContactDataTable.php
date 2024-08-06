<?php

namespace App\DataTables;

use App\Models\Contact;

/**
 * Class ContactDataTable
 */
class ContactDataTable
{
    /**
     * @return Contact
     */
    public function get()
    {
        /** @var Contact $query */
        $query = Contact::query()->select('contacts.*');

        return $query;
    }
}
