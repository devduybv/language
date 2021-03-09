<?php

namespace VCComponent\Laravel\Language\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use VCComponent\Laravel\Language\Entities\Language;
use VCComponent\Laravel\Language\Entities\Languageable;

trait HasLanguageTrait
{

    public function validateLanguageId($request)
    {
        $request->validate([
            'language_id' => ['required'],
        ]);
    }
    public function storeTranslateLanguage(Request $request, $id)
    {
        $this->validateLanguageId($request);
        $query = $this->entity->find($id);

        $language_trans = $this->translateCreate($query, $request);
        return $language_trans;
    }
    public function destroyTranslateLanguage(Request $request, $id)
    {
        $this->validateLanguageId($request);
        $query = $this->entity->find($id);
        if ($request->has('language_id')) {
            $query->detach($request->language_id);
        }
        return $this->success();
    }

    public function translateCreate($query, $request)
    {
        if ($request->has('language_id')) {
            $data = collect($request->all());
            $data->pull('language_id');
            $query->detach($request->language_id);
            foreach ($data as $key => $value) {
                $query->attachLanguages(
                    $request->language_id,
                    [
                        "field" => $key,
                        "value" => $value,
                    ]
                );
            }
            $language = Language::find($request->language_id)->code;

            Config::set([
                'app.locale' => $language,
            ]);

            return $this->response->item($query, new $this->transformer);
        }
    }

    public function languages()
    {
        $lagueconfig = config('app.locale');
        return $this->morphToMany(Language::class, 'languageable')->where('code', $lagueconfig)->withPivot('field', 'value')->withTimestamps();
    }

    public function translates()
    {
        return $this->hasMany(Languageable::class, 'languageable_id')->where('languageable_type', 'attributes');
    }
    public function attachLanguages($language_id, array $attributes = [])
    {
        $this->languages()->attach($language_id, $attributes);
    }

    public function detach($language_id)
    {
        $this->languages()->detach($language_id);
    }

    public function syncLanguages($language_id)
    {
        $this->languages()->sync($language_id);
    }
    public function getConfigLanguage($request)
    {
        Config::set([
            'app.locale' => $request->ref_lang,
        ]);
    }
    public function getField($field)
    {
        if (!$this->languages->count()) {
            return false;
        }
        try {
            return $this->languages()->where('field', $field)->first()->pivot->value;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getNameAttribute($value)
    {
        $trans              = $this->getField('name');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }

    public function getDescriptionAttribute($value)
    {
        $trans              = $this->getField('description');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }

    public function getPriceAttribute($value)
    {
        $trans              = $this->getField('price');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }

    public function getTitleAttribute($value)
    {
        $trans              = $this->getField('title');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }
    public function getLabelAttribute($value)
    {
        $trans              = $this->getField('label');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }

    public function getContentAttribute($value)
    {
        $trans              = $this->getField('content');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }

    public function getThumbnailAttribute($value)
    {
        $trans              = $this->getField('thumbnail');
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }

    public function translate($value, $trans)
    {
        if ($trans) {
            return $trans;
        } else {
            return $value;
        }
    }

    public function getMetaFieldTranslate($field, $value)
    {
        $trans              = $this->getField($field);
        $language_translate = $this->translate($value, $trans);
        return $language_translate;
    }

    public function getValueAttribute($value)
    {
        $field = $this->key;
        $trans = $this->getField($field);
        $language_translate = $this->translate($value,$trans);
        return $language_translate;
    }
}
