<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'coment';

    public function user()
    {
        return $this->belongsTo(User::class, 'inserter_id');
    }

    public function inserter()
    {
        return $this->belongsTo(Inserter::class, 'post_id');
    }
}
