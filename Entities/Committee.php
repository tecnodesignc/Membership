<?php

namespace Modules\Membership\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use Translatable;

    protected $table = 'membership__committees';
    public $translatedAttributes = ['name','description'];
    protected $fillable = ['options', 'name','description'];

    protected $casts = [
        'options' => 'array'
    ];

}
