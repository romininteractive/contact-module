<?php

namespace Modules\Contact\Tables;

use Illuminate\Http\Request;
use Modules\Contact\Form\ContactFilterForm;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Rarv\Button\Button;
use Modules\Rarv\Table\ExportTable;
use Modules\Rarv\Table\Table;

class ContactsTable extends Table
{
    protected $repository = ContactRepository::class;

    protected $filterForm = ContactFilterForm::class;
    protected $columns = [
        'full_name',
        'email',
        'phone'
    ];

    protected $exportable = true;

    public function __construct($module)
    {
        parent::__construct($module);

        $this->columns = config('asgard.contact.config.table_columns');
    }

    public function prepareButtons()
    {
        parent::prepareButtons();

        $this->addButton(new Button('Import', route('admin.contact.import'), 'primary', 'fa fa-upload'));
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
            $builder = $this->getRepository()->contactWhere(['user_type' => request()->get('type')]);
        }

        return $builder;
    }

    public function toExportable():?ExportTable
    {
        return new ExportContactsTable($this);
    }
}
