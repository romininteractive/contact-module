<?php

namespace Modules\Contact\Entities;

// namespace Notifications;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Modules\Contact\Entities\ContactAddress;
use Modules\Contact\Entities\Vehicle;
use Modules\Estimate\Entities\Estimate;
use Modules\Newnotification\Entities\Newnotification;
use Modules\Purchases\Entities\Purchases;
use Modules\Reminder\Entities\Reminder;

class Contact extends Model implements ContactInterface
{
    use Notifiable, Translatable;

    protected $table             = 'contact__contacts';
    public $translatedAttributes = [];
    protected $fillable          = ['salutation', 'first_name', 'last_name', 'company_name', 'email', 'phone', 'designation', 'gstin', 'department', 'type', 'user_type'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function purchase()
    {
        return $this->hasMany(Purchases::class);
    }

    public function getFullNameAttribute($value)
    {
        return ucfirst($this->first_name) . ' ' . $this->last_name;
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

    public function getPhone()
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

    public function estimate(){
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
        if($this->phone !=null){
            return ucfirst($this->first_name) . ' ' . $this->last_name .' - ' . $this->phone;
        }else{            
            return ucfirst($this->first_name) . ' ' . $this->last_name;
        }
    }    
}

