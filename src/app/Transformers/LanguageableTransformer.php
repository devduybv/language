<?php

namespace VCComponent\Laravel\Language\Transformers;

use League\Fractal\TransformerAbstract;

class LanguageableTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform($model)
    {
        return [
            'id'                => (int) $model->id,
            'languageable_type' => $model->languageable_type,
            'languageable_id'   => $model->languageable_id,
            'language_id'       => $model->language_id,
            'field'             => $model->field,
            'value'             => $model->value,
            'timestamps'        => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }
}
