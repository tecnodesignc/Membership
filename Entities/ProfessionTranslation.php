<?php

namespace Modules\Membership\Entities;

use Illuminate\Database\Eloquent\Model;

class ProfessionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description'];
    protected $table = 'membership__profession_translations';
}
