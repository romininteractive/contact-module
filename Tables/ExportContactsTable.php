<?php

namespace Modules\Contact\Tables;

use Modules\Contact\Entities\Contact;
use Modules\Rarv\Table\ExportTable;

class ExportContactsTable extends ExportTable {
    public function headings():array
    {
        $data = Contact::first();

        return array_keys($data->attributesToArray());
    }
}