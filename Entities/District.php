<?php

namespace Modules\Membership\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use Translatable;

    protected $table = 'membership__districts';
    public $translatedAttributes = ['name','description'];
    protected $fillable = ['name','description', 'options'];
    protected $casts = [
        'options' => 'array'
    ];

    public function congregation()
    {
        return $this->hasMany(Congregation::class);
    }
}
