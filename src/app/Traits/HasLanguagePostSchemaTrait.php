<?php
namespace VCComponent\Laravel\Language\Traits;

use App\Entities\PostMeta;

trait HasLanguagePostSchemaTrait
{
    public function postMetas()
    {
        return $this->hasMany(PostMeta::class);
    }
}
