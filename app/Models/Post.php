<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;


class Post extends Model
{
    use HasFactory, Commentable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'body',
        'image',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}
