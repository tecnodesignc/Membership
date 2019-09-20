<?php

namespace Modules\Membership\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use Translatable;

    protected $table = 'membership__studies';
    public $translatedAttributes = [];
    protected $fillable = [];

    protected $casts = [
        'options' => 'array'
    ];
}
