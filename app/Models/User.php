<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function movieHistories()
    {
        return $this->hasMany(MovieHistory::class);
    }

    public function getNonreadCommentCountsAttribute()
    {
        $movieHistories = $this->movieHistories()->get();

        $count = 0;
        foreach ($movieHistories as $movieHistory) {
            $count += $movieHistory->comments()->where('user_id', '!=', $this->id)->where('is_read', 0)->count();
        }

        return $count;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'comment',
        'img_path',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $url = url("reset-password/" . $token);
        $this->notify(new ResetPasswordNotification($url));
    }
}
