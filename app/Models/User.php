<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["name", "email", "password"];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    "email_verified_at" => "datetime",
  ];

    public function posts()
    {
        return $this->hasMany("App\Models\Post");
    }

    /*
     *
     * Get all pages in the db
     */
    public function pages()
    {
        return $this->hasMany("App\Models\Page");
    }

    public function isAdminOrEditor()
    {
        return $this->hasAnyRoles(["Admin", "Editor"]);
    }

    /*
     *
     */
    public function roles()
    {
        return $this->belongsToMany("App\Models\Role");
    }

    public function hasAnyRoles($roles)
    {
        return $this->roles()
      ->whereIn("name", $roles)
      ->first()
      ? true
      : false;
    }

    public function hasRole($role)
    {
        return $this->roles()
      ->where("name", $role)
      ->first()
      ? true
      : false;
    }
}
