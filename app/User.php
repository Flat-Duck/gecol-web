<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','n_id', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',// 'remember_token',
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
    public function balance()
    {
        return $this->consumer->balance();
    }
        /**
     * Validation rules
     *
     * @return array
     **/
    public static function validationRules($id = null)
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'n_id' => 'numeric|unique:users,n_id'.$id,
            'office_id'=> 'numeric'
        ];
    }

    /**
     * Get the providers for the Service.
     */
    public function main()
    {
        $data['user'] = $this;
        $data['user']['office_name'] = $this->consumer->office->name?? '-';
        $data['user']['office_city'] = $this->consumer->office->city?? '-';
        $data['user']['office_number'] = $this->consumer->office->number?? '-';
        $data['user']['counter_number'] = $this->counter->number?? '-';
        $data['user']['total_debt'] = $this->counter? $this->counter->total_debt()?? '-' : '-';
        $data['user']['reading_last'] = $this->counter? $this->counter->last_read()->value?? '-' : '-';
        $data['user']['reading_blat'] = $this->counter? $this->counter->before_last_read()->value?? '-' : '-';

        return $data;
        
    }
}
