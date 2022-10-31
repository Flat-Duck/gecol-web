<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
  // use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','n_id'
    ];

    /**
     * Validation rules
     *
     * @return array
     **/
    public static function validationRules()
    {
        return [
            'name' => 'required|string',
            'n_id' => 'nullable',
        ];
    }

    /**
     * Get the providers for the Service.
     */
    public function counter()
    {
        return $this->hasOne('App\Counter');
    }

    /**
     * Returns the paginated list of resources
     *
     * @return \Illuminate\Pagination\Paginator
     **/
    public static function getList()
    {
        return static::paginate(10);
    }
}