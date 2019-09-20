<?php

namespace Modules\Membership\Entities;

use Illuminate\Database\Eloquent\Model;

class StudyTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'membership__study_translations';
}
