<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function complaints()
    {
        return $this->belongsTo(Complaints::class, 'id_complaints');
    }
}
