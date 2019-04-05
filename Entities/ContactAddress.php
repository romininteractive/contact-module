<?php

namespace Modules\Contact\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Contact\Entities\Contact;

class ContactAddress extends Model
{
    use Translatable;

    protected $table = 'contact__contactaddresses';
    public $translatedAttributes = [];
    protected $fillable = ['contactId','name','address','city','state','zip_code','country','fax','billingphone'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
