<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Consumer extends Model
{
    use Searchable;

    /**
 * @var array Sets the fields that would be searched
 */
protected $searchableFields = ['*'];
  // use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','n_id','office_id'
    ];
    public function balance()
    {
        return $this->hasOne('App\Balance','consumer_id','id');
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
            'n_id' => 'numeric|unique:consumers,n_id,'.$id,
            'office_id'=> 'numeric'
        ];
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
    public function user()
    {
        return $this->belongsTo('App\User','n_id','n_id');
    }
        /**
     * Get the providers for the Service.
     */
    public function office()
    {
        return $this->belongsTo('App\Office');
    }
    public function toggleActivation(){
        $this->is_active = !$this->is_active;
        $this->save();
    }
    /**
     * Returns the paginated list of resources
     *
     * @return \Illuminate\Pagination\Paginator
     **/
    public static function getList($search)
    {
        return static::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();
        
    }
}