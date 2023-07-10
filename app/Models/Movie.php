<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function movieHistories()
    {
        return $this->hasMany(MovieHistory::class);
    }

    protected $fillable = [
        'title',
        'original_title',
        'category_id',
        'overview',
        'release_date',
        'img_path',
        'youtube_id'
    ];

    protected $guarded = ['created_at', 'updated_at'];
}
