<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = [
        'name',
        'domain'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


}

