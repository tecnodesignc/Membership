<?php

namespace Modules\Membership\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;
use Illuminate\Support\Arr;

class AddressTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'id' => $this->when($this->id, $this->id),
        'address' => $this->when($this->address, $this->address),
        'lat' => $this->when($this->lat, $this->lat),
        'lng' => $this->when($this->lng, $this->lng),
        'phone' => $this->when($this->phone, $this->phone),
        'users' => UserProfileTransformer::collection($this->whenLoaded('users')),
        'congregations' => CategoryTransformer::collection($this->whenLoaded('congregations')),
    ];


    return $data;

  }
}
