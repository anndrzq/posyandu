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
}
