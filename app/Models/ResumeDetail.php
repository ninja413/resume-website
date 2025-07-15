<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeDetail extends Model
{
    protected $fillable = [
        'user_id', 
        'photo', 
        'full_name', 
        'email', 
        'phone', 
        'address',
        'resume_body',
        'is_public'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
