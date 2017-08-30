<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name', 'code'
    ];

    /**
     * code mutator
     * @param $value
     */
    public function setCodeAttribute($value)
    {
        array_set($this->attributes, 'code', strtoupper($value));
    }

    /**
     * relationship with country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
