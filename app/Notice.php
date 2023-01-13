<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'counter_id','date'
    ];

    /**
     * Get the counter that owns the Notice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
