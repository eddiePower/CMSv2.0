<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ["title", "excerpt", "slug", "published_at", "body"];

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
}
