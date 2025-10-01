<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'slug',
        'status',
        'category_id',
        'provider_id',
        
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class);
    }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
