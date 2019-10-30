<?php

namespace Modules\Contact\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ContactRepository extends BaseRepository
{
    public function count();

    public function contactWhere(array $attributes);

    public function destroy($model);
}
