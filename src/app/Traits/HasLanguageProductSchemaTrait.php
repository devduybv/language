<?php
namespace VCComponent\Laravel\Language\Traits;

use App\Entities\ProductMeta;

trait HasLanguageProductSchemaTrait
{
    public function productMetas()
    {
        return $this->hasMany(ProductMeta::class);
    }
}
