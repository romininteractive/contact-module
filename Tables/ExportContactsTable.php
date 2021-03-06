<?php

namespace Modules\Contact\Tables;

use Modules\Contact\Entities\Contact;
use Modules\Rarv\Table\ExportTable;

class ExportContactsTable extends ExportTable {
    public function headings():array
    {
        $data = Contact::first();

        return array_merge(array_keys($data->attributesToArray()), ['country', 'state', 'city', 'zip_code', 'address']);
    }

    public function collection()
    {
        $this->table->setColumns(array_merge(['id'], $this->table->getColumns()));

        $records  = $this->table->getRecords(false);

        $records->each(function (&$contact) {
            $address = $contact->billingAddress();

            // Just for export logic column sequence...
            $contact->full_name = $contact->full_name;
            $contact->full_name_phone = $contact->full_name_phone;

            $contact->country = $address->country;
            $contact->state = $address->state;
            $contact->city = $address->city;
            $contact->zip_code = $address->zip_code;
            $contact->address = $address->address;
        });

        return $records;
    }
}