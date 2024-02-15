<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Immunization()
    {
        return $this->hasMany(Immunization::class);
    }
}
