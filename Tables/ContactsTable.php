<?php

namespace Modules\Contact\Tables;

use Illuminate\Http\Request;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Rarv\Table\Table;
use Modules\Rarv\Button\Button;

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

    public function prepareLinks()
    {

        parent::prepareLinks();

        $url        = route('admin.contact.contacts.show', '##id##');
        $addViewBtn = new Button('View', $url);

        $addViewBtn->weight   = 2;
        $this->addLink($addViewBtn);
    }


    public function getBuilder()
    {
        $builder = parent::getBuilder();

        if (request()->has('type')) {
            $builder = $this->getRepository()->where(['user_type' => request()->get('type')]);
        }

        return $builder;
    }
}
