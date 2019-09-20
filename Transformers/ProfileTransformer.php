<?php

namespace Modules\Marketplace\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Marketplace\Services\StoreHistory;
use Modules\User\Transformers\UserProfileTransformer;
use Illuminate\Support\Arr;

class ProfileTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'id' => $this->when($this->id, $this->id),
        'title' => $this->when($this->title, $this->title),
        'slug' => $this->when($this->slug, $this->slug),
        'description' => $this->description ?? '',
        'metaTitle' => $this->when($this->meta_title, $this->meta_title),
        'metaDescription' => $this->when($this->meta_description, $this->meta_description),
        'metaKeywords' => $this->when($this->meta_keywords, $this->meta_keywords),
        'mainImage' => $this->mainImage,
        'secondaryImage' => $this->when($this->secondaryImage, $this->secondaryImage),
        'createdAt' => $this->when($this->created_at, $this->created_at),
        'updatedAt' => $this->when($this->updated_at, $this->updated_at),
        'options' => $this->when($this->options, $this->options),
        'user'=>new UserProfileTransformer($this->whenLoaded('user')),
        'study'=>new StudyTransformer($this->whenLoaded('study')),
        'profession'=>new ProfessionTransformer($this->whenLoaded('profession')),
        'spouse'=>new UserProfileTransformer($this->whenLoaded('spouse')),
        'minister'=>new UserProfileTransformer($this->whenLoaded('minister')),
        'addresses' => AddressTransformer::collection($this->whenLoaded('addresses')),
    ];
    return $data;

  }
}
