<?php

namespace Modules\Contact\Events;

use Modules\Contact\Entities\Contact;

class ContactWasCreated
{
    /**
     * @var File
     */
    public $contact;
    /**
     * @var array
     */
    public $data;

    public function __construct(Contact $contact, array $data)
    {
        $this->contact = $contact;
        $this->data = $data;
    }
}
