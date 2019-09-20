<?php

namespace Modules\Membership\Entities;

use Illuminate\Database\Eloquent\Model;

class CommitteeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description'];
    protected $table = 'membership__committee_translations';
}
