<?php

namespace Modules\Contact\Imports;

use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use Modules\Contact\Entities\Contact;

class ContactImport implements WithHeadingRow, OnEachRow
{
    public function onRow(Row $row)
    {
        $contact = null;
        $row = $row->toArray();

        if (isset($row['updated_at'])) {
            unset($row['updated_at']);
        }

        if (isset($row['id'])) {
            $contact = Contact::find($row['id']);
            $contact->fill($row);
        }

        if (!$contact) {
            $contact = new Contact($row);
        }

        $contact->save();

        if (!$contact->billingAddress()) {
            $contact->createAddress();
        }

        $address = $contact->billingAddress();

        if (isset($row['country'])) {
            $address->country = $row['country'];
        }
        if (isset($row['state'])) {
            $address->state = $row['state'];
        }
        if (isset($row['city'])) {
            $address->city = $row['city'];
        }

        $address->save();
    }
}
