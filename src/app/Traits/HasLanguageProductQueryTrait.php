<?php
namespace VCComponent\Laravel\Language\Traits;

use Exception;
trait HasLanguageProductQueryTrait
{
    public function getMetaField($key)
    {
        if (!$this->productMetas->count()) {
            return '';
        }
        try {
            $product_meta   = $this->productMetas->where('key', $key)->first();
            $meta           = $this->productMetas->where('key', $key)->first()->value;
            $meta_translate = $product_meta->getMetaFieldTranslate($key, $meta);
            return $meta_translate;
        } catch (Exception $e) {
            return '';
        }
    }
}
