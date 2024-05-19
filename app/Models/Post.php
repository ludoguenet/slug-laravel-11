<?php

namespace App\Models;

use App\Concerns\HasSlug;
use App\Contracts\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Sluggable
{
    use HasFactory;
    use HasSlug;

    public function slugAttribute(): string
    {
        return 'title';
    }

    protected $fillable = [
        'title',
        'slug',
    ];
}
