<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class family extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    public function users()
    {
        // awal hasmany
        return $this->belongsTo(User::class, 'family_id');
    }

    public function child()
    {
        return $this->hasMany(Child::class);
    }
}
