<?php

namespace App\Models;

use Illulnate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
