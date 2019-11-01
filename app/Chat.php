<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;
    protected $fillable = ['starter_id','user_id'];
    protected $dates = ['deleted_at'];
    public function starter() {
        return $this->belongsTo('App\User', 'starter_id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function messages() {
        return $this->hasMany('App\Message');
    }
}
