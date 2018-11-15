<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactAddressTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'contact__contactaddress_translations';
}
