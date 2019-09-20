<?php

namespace Modules\Membership\Entities;

use Illuminate\Database\Eloquent\Model;

class WorkstationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description'];
    protected $table = 'membership__workstation_translations';
}
