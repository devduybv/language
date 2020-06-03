<?php

namespace VCComponent\Laravel\Language\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;
use VCComponent\Laravel\Vicoders\Core\Validators\ValidatorInterface;

class LanguageValidator extends AbstractValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required', 'unique:languages'],
            'code' => ['required', 'unique:languages'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'code' => ['required'],
        ],

    ];
}
