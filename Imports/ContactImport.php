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

        unset($row['type']);

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

        // Set the default user type of not specified
        if (strtolower($contact['user_tye']) != 'customer' && strtolower($contact['user_type']) != 'vendor') {
            $contact['user_type'] = 'customer';
        }

        $contact->phone = $contact['mobile1'];
        $contact->save();

        if (!$contact->billingAddress()) {
            $contact->createAddress();
        }


        $address = $contact->billingAddress();

        $address->billingphone = $contact['phone'];

        if (isset($row['country'])) {
            $address->country = $row['country'];
        }
        if (isset($row['state'])) {
            $address->state = $row['state'];
        }
        if (isset($row['city'])) {
            $address->city = $row['city'];
        }
        if (isset($row['address'])) {
            $address->address = $row['address'];
        }
        if (isset($row['zip_code'])) {
            $address->zip_code = $row['zip_code'];
        }

        $address->save();
    }
}
