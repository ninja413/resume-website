<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;
use App\Models\User;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
