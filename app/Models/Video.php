<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'video'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //relacion uno a muchos un video tiene muchos comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }

    //relacion uno a uno Un video pertenece (belongs to) a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
