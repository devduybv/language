<?php

namespace VCComponent\Laravel\Language\Entities;

use Illuminate\Database\Eloquent\Model;

class Languageable extends Model
{
    protected $fillable = [
        'languageables',
        'languageable_type',
        'languageable_id',
        'language_id',
        'value',
        'field',
    ];
}
