<?php

namespace Modules\Contact\Entities;
use Modules\Contact\Entities\Vehicle;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Translatable;

    protected $table = 'contact__contacts';
    public $translatedAttributes = [];
    protected $fillable = ['salutation','first_name','last_name','company_name','email','phone','designation','gstin','department','type'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
