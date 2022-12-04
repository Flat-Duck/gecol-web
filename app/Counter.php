<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Counter extends Model
{
    use Searchable;  
    
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
            'reading' => 'nullable,'.$id,
        ];
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
