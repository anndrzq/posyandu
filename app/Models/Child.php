<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    public function parent()
    {
        return $this->belongsTo(family::class, 'family_id');
    }

    public function Weighing()
    {
        return $this->hasMany(Weighing::class);
    }

    public function Immunization()
    {
        return $this->hasMany(Immunization::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaints::class);
    }

    public static function countChild()
    {
        return self::count();
    }
}
