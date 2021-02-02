<?php

namespace VCComponent\Laravel\Language\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\Language\Entities\Languageable;

/**
 * Class AccountantRepositoryEloquent.
 */
class LanguageableRepositoryEloquent extends BaseRepository implements LanguageableRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Languageable::class;
    }

    public function getEntity()
    {
        return $this->model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
