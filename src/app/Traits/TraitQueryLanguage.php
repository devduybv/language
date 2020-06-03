<?php

namespace VCComponent\Laravel\Language\Traits;

use Exception;
use VCComponent\Laravel\Vicoders\Core\Exceptions\NotFoundException;

trait TraitQueryLanguage
{

    public function getField($field)
    {
        if ($this->languages->count()) {
            throw new NotFoundException($field . ' field');
        }
        try {
            return $this->languages()->where('field', $field)->first()->value;
        } catch (Exception $e) {
            throw new NotFoundException($field . ' field');
        }
    }
}
