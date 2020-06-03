<?php

namespace VCComponent\Laravel\Generator\Entities;

use Illuminate\Database\Eloquent\Model;

class Languageable extends Model
{
    protected $fillable = [
        'languageables',
        'languageable_id',
        'language_id',
        'value',
        'field',
    ];
}
