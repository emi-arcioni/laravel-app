<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use SoftDeletes;
    
    protected $table = 'entries';
    protected $fillable = ['title', 'content'];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
