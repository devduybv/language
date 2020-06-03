<?php

namespace VCComponent\Laravel\Language\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtolower($value);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }
}
