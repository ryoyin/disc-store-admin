<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'disc_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function disc()
    {
        return $this->hasOne(Disc::class, 'id', 'disc_id');
    }
}
