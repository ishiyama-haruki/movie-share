<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieHistory extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getNonreadCommentCountsAttribute()
    {
        return $this->comments()->where('user_id', '!=', $this->user_id)->where('is_read', 0)->count();
    }

    protected $fillable = [
        'user_id',
        'movie_id',
        'viewing_date',
        'evaluation',
        'place',
        'impression',
        'viewing_count',
        'accessible'
    ];

    protected $guarded = ['created_at', 'updated_at'];
}
