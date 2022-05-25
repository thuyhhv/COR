<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
    ];

    public function setAvatarAttribute($value)
    {
        $this->attributes['avatar'] = json_encode($value);
    }
}
