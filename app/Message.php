<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $fillable = ['sender_id', 'chat_id', 'message'];
    protected $dates = ['deleted_at'];
    public function sender() {
        return $this->belongsTo('App\User', 'sender_id');
    }
    public function chat() {
        return $this->belongsTo('App\Chat');
    }
}
