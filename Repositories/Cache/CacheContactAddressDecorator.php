<?php

namespace Modules\Contact\Repositories\Cache;

use Modules\Contact\Repositories\ContactAddressRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheContactAddressDecorator extends BaseCacheDecorator implements ContactAddressRepository
{
    public function __construct(ContactAddressRepository $contactaddress)
    {
        parent::__construct();
        $this->entityName = 'contact.contactaddresses';
        $this->repository = $contactaddress;
    }
}
