<?php

namespace Modules\Membership\Entities;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'membership__profiles';
    protected $fillable = [
        'user_id',
        'doc_type',
        'identification',
        'birthday',
        'birthplace',
        'study_id',
        'profession_id',
        'civil_status',
        'spouse_id',
        'baptism_date',
        'minister_id',
        'holy_spirit_date'

    ];

    protected $casts = [
        'options' => 'array',
        'baptism_date'=>'timestamp',
        'birthday'=>'timestamp',
        'holy_spirit_date'=>'timestamp',
    ];
    public function addresses()
    {
        $this->morphToMany(Congregation::class, 'addressable','membership_addressable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function study()
    {
        $this->belongsTo(Study::class);
    }
    public function profession()
    {
        $this->belongsTo(Profession::class);
    }
    public function spouse()
    {
        return $this->belongsTo(User::class,'spouse_id');
    }
    public function minister()
    {
        return $this->belongsTo(User::class,'minister_id');
    }
}
