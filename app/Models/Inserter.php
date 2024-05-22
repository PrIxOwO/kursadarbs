<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inserter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'data';

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user');
    }

    public function coments()
    {
        return $this->hasMany(Coment::class, 'post_id');
    }
}
