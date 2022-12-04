<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Counter extends Model
{
    use Searchable;  
    
            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'n_id','number'
    ];

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
            'number' => 'required|string',
            'n_id' => 'nullable'.$id,
        ];
    }
    public function toggleActivation(){
        $this->is_active = !$this->is_active;
        $this->save();
    }

        /**
     * Get the providers for the Service.
     */
    public function readings()
    {
        return $this->hasMany('App\Reading','number','number');
    }
    public function last_read()
    {
        return $this->readings->last();
        
    }
    public function before_last_read()
    {
        return $this->readings->sortByDesc('id')->values()->skip(1)->take(1)->first();
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
