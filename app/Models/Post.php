<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'websiteId'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class, 'websiteId');
    }
}
