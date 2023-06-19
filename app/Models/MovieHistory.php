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

    protected $fillable = [
        'user_id',
        'movie_id',
        'viewing_date',
        'evaluation',
        'place',
        'impression',
        'viewing_count'
    ];

    protected $guarded = ['created_at', 'updated_at'];
}
