<?php

namespace Modules\Membership\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;
use Illuminate\Support\Arr;

class WorkstationTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'id' => $this->when($this->id, $this->id),
        'name' => $this->when($this->title, $this->title),
        'description' => $this->when($this->description, $this->description),
        'options' => $this->when($this->meta_title, $this->meta_title),
        'committee' => new CategoryTransformer($this->whenLoaded('committee')),
    ];

    $filter = json_decode($request->filter);

    // Return data with available translations
    if (isset($filter->allTranslations) && $filter->allTranslations) {
      // Get langs avaliables
      $languages = \LaravelLocalization::getSupportedLocales();

      foreach ($languages as $lang => $value) {
          $data[$lang]['name'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['name'] : '';
          $data[$lang]['description'] = $this->hasTranslation($lang) ?
              $this->translate("$lang")['description'] : '';
      }
    }

    return $data;

  }
}
