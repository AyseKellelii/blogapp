<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name','slug'];

    public function posts()
    {
        return $this->belongsToMany(PostModel::class, 'category_post', 'category_id', 'post_id');
    }

}
