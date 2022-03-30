<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'description',
        'author_id',
        'url'
    ];

    public function getTitleWithAuthorAttribute() {
        return $this->title . ' - ' . $this->author->name;
    }

    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function students() {
        return $this->belongsToMany(
            User::class,
            'course_users',
            'course_id',
            'user_id'
        );
    }
}
