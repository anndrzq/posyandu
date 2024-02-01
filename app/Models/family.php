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
        return $this->hasMany(User::class, 'family_id');
    }

    public function child()
    {
        return $this->hasMany(Child::class, 'familu_id');
    }
}
