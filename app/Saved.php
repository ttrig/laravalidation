<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Saved extends Model
{
    use HasFactory;

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
