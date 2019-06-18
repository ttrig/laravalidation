<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    protected $table = 'saved';

    protected $guarded = [];

    protected $hidden = [
        'id',
        'ip',
    ];

    public function scopeHashid($query, string $encodedString)
    {
        return $query->where('id', Hashids::decode($encodedString));
    }

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }
}
