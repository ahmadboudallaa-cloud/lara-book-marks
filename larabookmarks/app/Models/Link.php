<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'url', 'category_id', 'user_id'];

   public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function tags()
{
    return $this->belongsToMany(Tag::class); // Relation Many-to-Many avec table link_tag
}


}
