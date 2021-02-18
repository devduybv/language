<?php

namespace VCComponent\Laravel\Language\Traits;

use Exception;
use VCComponent\Laravel\Language\Entities\Language;

trait HasLanguageOptionTrait
{
    public function languages()
    {
        $lagueconfig = config('app.locale');
        return $this->morphToMany(Language::class, 'languageable')->where('code', $lagueconfig)->withPivot('field', 'value')->withTimestamps();
    }

    public function getField($field)
    {
        if (!$this->languages->count()) {
            return false;
        }
        try {
            return $this->languages()->where('field', $field)->first()->pivot->value;
        } catch (Exception $e) {
            return false;
        }
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
        $trans              = $this->getField('value');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }
}


