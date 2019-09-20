<?php

namespace Modules\Membership\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use Translatable;

    protected $table = 'membership__addresses';
    protected $fillable = ['address','lat','lng','phone'];

    protected $casts = [
        'options' => 'array',
        'phone'=>'array'
    ];
    public function users()
    {
        $this->morphedByMany(Profile::class, 'addressable','membership_addressable');
    }
    public function congregations()
    {
        $this->morphedByMany(Congregation::class, 'addressable','membership_addressable');
    }
}
