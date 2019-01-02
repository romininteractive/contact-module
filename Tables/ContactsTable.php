<?php

namespace Modules\Contact\Tables;

use Illuminate\Http\Request;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Rarv\Table\Table;

class ContactsTable extends Table
{
	protected $repository = ContactRepository::class;	

	protected $columns = [
		'full_name', 
		'email',
		'phone'
	];

	public function getRecords()
	{
		if (!request()->type) {
            $contacts = $this->getRepository()->all();
        } else {
            $contacts = $this->getRepository()->getByAttributes(['user_type' => request()->type]);
        }

        return $contacts;
	}
}