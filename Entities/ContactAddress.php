<?php

namespace Modules\Contact\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Contact\Entities\Contact;
use Modules\Location\Entities\Location;

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

    public function getName()
    {
        return $this->name;
    }

    public function getStateAttribute($value)
    {
        if(is_module_enabled('Location') and $this->city != '' and ($value == null || $value == '')){
            $location = Location::where('city', $this->city)->first();
            $this->state = $location->state;
            $this->save();

            return $location->state;
        }
        
        return $value;
    }

    public function getCountryAttribute($value)
    {
        if(is_module_enabled('Location') and $this->city != '' and ($value == null || $value == '')){
            $location = Location::where('city', $this->city)->first();
            $this->country = $location->country;
            $this->save();

            return $location->country;
        }
        
        return $value;
    }
}
