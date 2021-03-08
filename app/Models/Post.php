<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Post extends Model
{
    use HasFactory;
    use PresentableTrait;

    protected $presenter = "App\Presenters\PostPresenter";

    protected $fillable = ["title", "excerpt", "slug", "published_at", "body"];

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
}
