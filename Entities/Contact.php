<?php

namespace Modules\Contact\Entities;

// namespace Notifications;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\Accounting\Entities\Bills;
use Modules\Accounting\Entities\Invoices;
use Modules\Contact\Entities\ContactAddress;
use Modules\Contact\Entities\Vehicle;
use Modules\Estimate\Entities\Estimate;
use Modules\Newnotification\Entities\Newnotification;
use Modules\Purchases\Entities\Purchases;
use Modules\Quotation\Entities\Quote;
use Modules\Reminder\Entities\Reminder;

class Contact extends Model implements ContactInterface
{
    use SoftDeletes, Notifiable, Translatable;

    protected $table             = 'contact__contacts';
    public $translatedAttributes = [];
    protected $fillable          = ['salutation', 'first_name', 'last_name', 'company_name', 'email', 'phone', 'designation', 'gstin', 'department', 'type', 'user_type'];
    protected $dates = ['deleted_at'];

    protected $appends = ['full_name', 'full_name_phone'];

    public function __construct(array $attributes = [])
    {
        if (config('asgard.contact.config.fillable') !=null) {
            $this->fillable = array_merge($this->fillable, config('asgard.contact.config.fillable'));
        }

        parent::__construct($attributes);
    }
    
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function billingAddress()
    {
        // @todo Implement caching
        return $this->addresses()->where('type', 'billing')->first();
    }

    public function addresses()
    {
        return $this->hasMany(ContactAddress::class, 'contactId');
    }

    public function purchase()
    {
        return $this->hasMany(Purchases::class);
    }

    public function getFullNameAttribute($value)
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function newnotification()
    {
        return $this->hasMany(Newnotification::class);
    }

    public function getName()
    {
        return $this->full_name;
    }

    public function mobileNo()
    {
        return $this->phone;
    }
    /**
     * Return the user's email address
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Return the user's device ID
     * for sending push notification
     */
    public function getDeviceId()
    {
        return null;
    }

    public function estimate()
    {
        return $this->hasMany(Estimate::class);
    }

    public static function fieldValues($type)
    {
        $contacts = self::whereUserType($type)->get();
        $data = [];

        foreach ($contacts as &$contact) {
            $data[$contact->id] = $contact->full_name;
        }

        return $data;
    }

    public function typeClass()
    {
        switch ($this->user_type) {
            case 'customer':
                return 'success';
                break;

            case 'vendor':
                return 'warning';
                break;
            
            default:
                return 'info';
                break;
        }
    }
    public function getFullNamePhoneAttribute($value)
    {
        if ($this->phone !=null) {
            return ucfirst($this->first_name) . ' ' . $this->last_name .' - ' . $this->phone;
        } else {
            return ucfirst($this->first_name) . ' ' . $this->last_name;
        }
    }

    public function invoices()
    {
        return $this->hasMany(Invoices::class, 'customer_id');
    }
    public function bills()
    {
        return $this->hasMany(Bills::class, 'vendor_id');
    }

    public function getGstStateCodeAttribute()
    {
        $state_name = null;
        $state_code = substr($this->gstin, 0, 2);
        $states = config('asgard.contact.gst_states');
        $gst_states = $states['gst_state_code'];
        if (array_key_exists($state_code, $gst_states)) {
            $state_name = $gst_states[$state_code];
        }
        return $state_name;
    }

    public function gstState($gstno = null)
    {
        if ($gstno == null) {
            $gstno = $this->gstin;
        }

        $state_name = null;
        $state_code = substr($gstno, 0, 2);
        $states = config('asgard.contact.gst_states');
        $gst_states = $states['gst_state_code'];
        if (array_key_exists($state_code, $gst_states)) {
            $state_name = $gst_states[$state_code];
        }
        return $state_name;
    }

    public function getGstStateCode()
    {
        $state_code = substr($this->gstin, 0, 2);
        return $state_code;
    }

    public function createAddress($type = 'billing')
    {
        $address = $this->billingAddress();

        if ($address) {
            return false;
        }

        $address = new ContactAddress;
        $address->contactId = $this->id;
        $address->type = $type;

        $address->name = $this->getName();
        // address, city, zip_code, state, country, fax, billingphone
        $address->billingphone = $this->mobileNo();

        $address->save();

        return $address;
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'customer_id');
    }
}

