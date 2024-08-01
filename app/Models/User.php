<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'profile_picture', 'active',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->id)) {
                $user->id = (string) Str::uuid();
            }
        });

        static::deleting(function ($user) {
            $user->posts()->each(function ($post) {
                $post->comments()->delete(); 
                $post->delete(); 
            });
            $user->comments()->delete(); 
        });
    }

    public function isAdmin()   
    {
        return $this->role === 'admin';
    }

    public function isActive()
    {
        return $this->active;
    }
}
