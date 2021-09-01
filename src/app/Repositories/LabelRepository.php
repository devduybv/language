<?php

namespace VCComponent\Laravel\Language\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface Repository.
 */
interface LabelRepository extends RepositoryInterface
{
    //
    public function applyQueryScope($query, $field, $value);
    public function getEntity();
}
