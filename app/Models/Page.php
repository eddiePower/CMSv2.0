<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laracasts\Presenter\PresentableTrait;

class Page extends Model
{
    use HasFactory;
    use NodeTrait;
    use PresentableTrait;

    protected $fillable = ["title", "url", "content"];
    protected $presenter = "App\Presenters\PagePresenter";

    public function users()
    {
        return $this->belongsTo("App\Models\User");
    }

    public function UpdatePageOrder($order, $orderPage)
    {
        $relativePage = Page::findOrFail($orderPage);

        if ($order == "before") {
            $this->beforeNode($relativePage)->save();
        } elseif ($order == "after") {
            $this->afterNode($relativePage)->save();
        } else {
            $relativePage->appendNode($this);
        }

        Page::fixTree();
    }
}
