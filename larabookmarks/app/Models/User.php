<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
    'name',
    'email',
    'password',
    'is_active', 
];

    protected $hidden = ['password'];

    public function categories()
{
    return $this->hasMany(Category::class);
}

public function links()
{
    return $this->hasMany(Link::class);
}

}
