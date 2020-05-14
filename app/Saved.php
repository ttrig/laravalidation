<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
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
        return $query->where('id', Hashids::decode($encodedString) ?: null);
    }

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }
}
