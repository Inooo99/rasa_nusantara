<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    // Komen milik User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Komen punya balasan (anak komentar)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}