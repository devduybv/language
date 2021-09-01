<?php

namespace VCComponent\Laravel\Language\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\Language\Entities\Label;

/**
 * Class AccountantRepositoryEloquent.
 */
class LabelRepositoryEloquent extends BaseRepository implements LabelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        if (isset(config('language.models')['label'])) {
            return config('language.models.label');
        } else {
            return Label::class;

        }
    }

    public function getEntity()
    {
        return $this->model;
    }
    public function applyQueryScope($query, $field, $value)
    {
        $query = $query->where($field, $value);
        return $query;
    }
}
