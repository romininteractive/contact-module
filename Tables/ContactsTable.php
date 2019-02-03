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

    public function __construct($module)
    {
        parent::__construct($module);

        $this->columns = config('asgard.contact.config.table_columns');
    }

    public function getBuilder()
    {
        $builder = parent::getBuilder();

        if(request()->has('type')){
            $builder = $this->getRepository()->where(['user_type' => request()->get('type')]);
        }

        return $builder;
    }
}
