<?php

namespace Modules\Contact\Repositories\Eloquent;

use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

/**
 * Eloquent implementation for contact
 */
class EloquentContactRepository extends EloquentBaseRepository implements ContactRepository
{
    public function count()
    {
        return $this->model->count();
    }

    public function where(array $attributes)
    {
        return $this->model->where($attributes);
    }
}
