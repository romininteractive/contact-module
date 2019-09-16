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

    public function destroy($model)
    {
        if (is_module_enabled('Accounting')) {
            if (count($model->invoices) > 0 || count($model->bills)) {
                throw new \Exception("Not allowed to delete! Customer contain invoices or bills ", 1);
            }
        }
        return $model->delete();
    }
}
