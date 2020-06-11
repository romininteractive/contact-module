<?php

namespace Modules\Contact\Exports;

use Modules\Rarv\Table\ExportTable;

class ContactExportTable extends ExportTable
{
    protected $table = null;

    public function collection()
    {
        $this->table->setColumns(array_merge(['id'], $this->table->getColumns()));

        $records  = $this->table->getRecords(false);

        $records->each(function (&$contact) {
            $address = $contact->billingAddress();

            $contact->country = $address->country;
            $contact->state = $address->state;
            $contact->city = $address->city;
            $contact->zip_code = $address->zip_code;
            $contact->address = $address->address;
        });

        return $records;
    }
}
