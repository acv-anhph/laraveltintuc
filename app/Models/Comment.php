<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    public function tintuc()
    {
        return $this->belongsTo('App\Models\TinTuc', 'idTinTuc', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'idUser', 'id');
    }
}
