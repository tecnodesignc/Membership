<?php

namespace Modules\Membership\Entities;

use Illuminate\Database\Eloquent\Model;

class CongregationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description','slug'];
    protected $table = 'membership__congregation_translations';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
