<?php

namespace Modules\Contact\Repositories\Cache;

use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheContactDecorator extends BaseCacheDecorator implements ContactRepository
{
    public function __construct(ContactRepository $contact)
    {
        parent::__construct();
        $this->entityName = 'contact.contacts';
        $this->repository = $contact;
    }
}
