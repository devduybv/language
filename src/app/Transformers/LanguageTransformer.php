<?php

namespace VCComponent\Laravel\Language\Transformers;

use League\Fractal\TransformerAbstract;

class LanguageTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform($model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'code'       => $model->code,
            'timestamps' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }
}
