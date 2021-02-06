<?php
namespace VCComponent\Laravel\Language\Traits;

use Exception;
trait HasLanguagePostQueryTrait
{
    public function getMetaField($key)
    {
        if (!$this->postMetas->count()) {
            return '';
        }
        try {
            $post_meta      = $this->postMetas->where('key', $key)->first();
            $meta           = $this->postMetas->where('key', $key)->first()->value;
            $meta_translate = $post_meta->getMetaFieldTranslate($key, $meta);
            return $meta_translate;
        } catch (Exception $e) {
            return '';
        }
    }

}
