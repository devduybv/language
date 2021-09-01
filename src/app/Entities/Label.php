<?php

namespace VCComponent\Laravel\Language\Entities;

use Illuminate\Database\Eloquent\Model;
use VCComponent\Laravel\Language\Entities\Language;
use VCComponent\Laravel\Language\Traits\HasLanguageTrait;

class Label extends Model
{
    use HasLanguageTrait;

    protected $fillable = [
        'type',
        'key',
        'value',
    ];

    public function languages()
    {
        $lagueconfig = config('app.locale');
        return $this->morphToMany(Language::class, 'languageable')->where('code', $lagueconfig)->withPivot('field', 'value')->withTimestamps();
    }
    public function scopeCheckHasLanguage($q, $language_session)
    {
        $q->whereHas('languages', function ($l) use ($language_session) {
            $l->where('code', $language_session);
        });
    }
    public function translate($value, $trans)
    {
        if ($trans) {
            return ucfirst($trans);
        } else {
            return ucfirst($value);
        }
    }
    public function getValueAttribute($value)
    {
        $trans = $this->getField('value');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }
}
