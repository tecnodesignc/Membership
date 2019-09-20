<?php

namespace Modules\Membership\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use Translatable;

    protected $table = 'membership__professions';
    public $translatedAttributes = ['name','description'];
    protected $fillable = ['name','description','options'];

    protected $casts = [
        'options' => 'array'
    ];
}
