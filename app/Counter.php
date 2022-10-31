<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    
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
