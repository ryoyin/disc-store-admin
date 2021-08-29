<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disc extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(DiscImage::class);
    }

    public function discFormat()
    {
        return $this->belongsTo(DiscFormat::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

}
