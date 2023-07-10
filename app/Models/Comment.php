<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movieHistory()
    {
        return $this->belongsTo(MovieHistory::class);
    }

    protected $fillable = [
        'user_id',
        'movie_history_id',
        'message'
    ];

    protected $guarded = ['created_at', 'updated_at'];
}
