<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;
use Illuminate\Support\Arr;

class CongregationTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'id' => $this->when($this->id, $this->id),
        'name' => $this->when($this->name, $this->name),
        'slug' => $this->when($this->slug, $this->slug),
        'description' => $this->when($this->description, $this->description),
        'social' => $this->when($this->slug, $this->slug),
        'options' => $this->when($this->slug, $this->slug),
        'distric' => new DistrictTransformer($this->whenLoaded('distric')),
        'addresses' => AddressTransformer::collection($this->whenLoaded('addresses')),
    ];

    $filter = json_decode($request->filter);

    // Return data with available translations
    if (isset($filter->allTranslations) && $filter->allTranslations) {
      // Get langs avaliables
      $languages = \LaravelLocalization::getSupportedLocales();

      foreach ($languages as $lang => $value) {
          $data[$lang]['title'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['title'] : '';
          $data[$lang]['slug'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['slug'] : '';
          $data[$lang]['description'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['description'] ?? '' : '';
          $data[$lang]['metaTitle'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['meta_title'] : '';
          $data[$lang]['metaDescription'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['meta_description'] : '';
      }
    }

    return $data;

  }
}
