<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
use phpDocumentor\Reflection\Types\Boolean;

class Reading extends Model
{
    use Searchable;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date','value','number'
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

            /**
     * Get the providers for the Service.
     */
    public function counter()
    {
        return $this->belongsTo('App\Counter','number','number');
    }

    /**
     * @var array Sets the fields that would be searched
     */
    protected $searchableFields = ['*'];

    /**
     * Validation rules
     *
     * @return array
     **/
    public static function validationRules($id = null)
    {
        return [
            'date' => 'required|date',
            'value' => 'required|numeric',
            'number' => 'required|numeric',
        ];
    }

}
