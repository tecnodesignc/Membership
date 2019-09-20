<?php

namespace Modules\Membership\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    use Translatable;

    protected $table = 'membership__workstations';
    public $translatedAttributes = ['name','description'];
    protected $fillable = ['name','description','committee_id', 'options'];

    protected $casts = [
        'options' => 'array'
    ];

    public function committee()
    {
        $this->belongsTo(Committee::class);
    }
}
