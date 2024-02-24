<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proof()
    {
        return $this->hasMany(Proof::class, 'complaints_id');
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
