<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Midwife extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class, 'midwife_id', 'id');
    }

    public static function countMidwife()
    {
        return self::count();
    }
}
