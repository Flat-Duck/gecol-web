<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','n_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the providers for the Service.
     */
    public function consumer()
    {
        return $this->hasOne('App\Consumer','n_id','n_id');
    }

    /**
     * Get the providers for the Service.
     */
    public function counter()
    {
        return $this->hasOne('App\Counter','n_id','n_id');
    }

    /**
     * Get the providers for the Service.
     */
    public function main()
    {
        $data['user'] = $this;
        $data['user']['office_name'] = $this->consumer->office->name;
        $data['user']['office_city'] = $this->consumer->office->city;
        $data['user']['office_number'] = $this->consumer->office->number;
        $data['user']['counter_number'] = $this->counter->number;
        $data['user']['reading_last'] = $this->counter->last_read()->value?? '-';
        $data['user']['reading_blat'] = $this->counter->before_last_read()->value?? '-';

        return $data;
        
    }
}
