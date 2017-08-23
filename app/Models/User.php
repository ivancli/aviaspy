<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    protected $appends = [
        'full_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * first_name accessor
     * @param $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * last_name accessor
     * @param $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * first name mutator
     * @param $value
     */
    public function setFirstNameAttribute($value)
    {
        array_set($this->attributes, 'first_name', strtolower($value));
    }

    /**
     * last name mutator
     * @param $value
     */
    public function setLastNameAttribute($value)
    {
        array_set($this->attributes, 'last_name', strtolower($value));
    }

    /**
     * fullName attribute
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
