<?php

namespace Modules\Membership\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Congregation extends Model
{
    use Translatable;

    protected $table = 'membership__congregations';
    public $translatedAttributes = ['name','description','slug'];
    protected $fillable = ['name','description','social','district_id','options','slug'];
    protected $casts = [
        'options' => 'array'
    ];
    public function addresses()
    {
      return  $this->morphToMany(Address::class, 'addressable','membership_addressable');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
