<?php

namespace VCComponent\Laravel\Language\Transformers;

use League\Fractal\TransformerAbstract;

class LabelTransformer extends TransformerAbstract
{

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform($model)
    {
        return [
            'id' => (int) $model->id,
            'type' => $model->type,
            'key' => $model->key,
            'value' => $model->value,
            'timestamps' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }
}
