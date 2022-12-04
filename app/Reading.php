<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\Searchable;
class Reading extends Model
{
    use Searchable;
            /**
     * @var array Sets the fields that would be searched
     */
    protected $searchableFields = ['*'];
}
