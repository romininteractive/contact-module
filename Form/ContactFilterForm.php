<?php

namespace Modules\Contact\Form;

use Modules\Contact\Entities\Contact;
use Modules\Rarv\Form\Fields\SelectField;
use Modules\Rarv\Form\FilterForm;

class ContactFilterForm extends FilterForm
{
    public function boot()
    {
        $this->setField('first_name', 'normalInput')
            ->setColumn(3)
            ->setLabel('Name');
        $this->setField('company_name', 'normalInput')
            ->setColumn(3)
            ->setLabel('Company');
        $this->setField('phone', 'normalInput')
            ->setColumn(3)
            ->setLabel('Phone');
    }

}
