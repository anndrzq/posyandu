<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weighing extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
