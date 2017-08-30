<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'official',
        'iso_alpha_2',
        'iso_alpha_3',
        'iso_numeric',
    ];

    /**
     * iso alpha 2 mutator
     * @param $value
     */
    public function setIsoAlpha2Attribute($value)
    {
        array_set($this->attributes, 'iso_alpha_2', strtoupper($value));
    }

    /**
     * iso alpha 3 mutator
     * @param $value
     */
    public function setIsoAlpha3Attribute($value)
    {
        array_set($this->attributes, 'iso_alpha_3', strtoupper($value));
    }

    /**
     * relationship with City
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
}
