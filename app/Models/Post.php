<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;


class Post extends Model
{
    use HasFactory, Commentable, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'body',
        'image',
        'user_id',
        'type'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
