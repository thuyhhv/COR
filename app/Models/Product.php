<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pro_name',
        'pro_avatar',
        'pro_quantity',
        'pro_price',
        'description',
        'pro_parent_id',
        'created_by',
    ];

    public function setProAvatarAttribute($value)
    {
        $this->attributes['pro_avatar'] = json_encode($value);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }
}
