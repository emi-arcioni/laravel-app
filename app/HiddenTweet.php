<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HiddenTweet extends Model
{
    use SoftDeletes;
    
    protected $table = 'hidden_tweets';
    protected $fillable = ['user_id', 'tweet_id'];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
