<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
