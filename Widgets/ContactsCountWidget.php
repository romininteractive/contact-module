<?php

namespace Modules\Contact\Widgets;

use Modules\Contact\Repositories\ContactRepository;
use Modules\Dashboard\Foundation\Widgets\BaseWidget;
use Modules\Contact\Entities\Contact;
/**
 * @author Daksh Mehta <dm@rimail.in>
 */
class ContactsCountWidget extends BaseWidget
{
    private $contacts;

    public function __construct(ContactRepository $contacts)
    {
        $this->contacts = $contacts;
    }

    public function name()
    {
        return 'ContactsCountWidget';
    }

    public function options()
    {
        return [
            'width' => 3,
            'x' => 0,
            'y' => 0,
        ];
    }

    public function data()
    {
        return ['count' => Contact::count()];
    }

    public function view()
    {
        return 'contact::admin.widgets.contacts-count';
    }
}
