<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles() {
        return $this->belongsToMany('App\Role');
     }
     use EntrustUserTrait;


     public static function findNearest($latitude, $longitude) {
        $users = User::select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( lat ) ) ) ) AS distance'))
                ->having('distance', '<', 5)
                ->orderBy('distance')
                ->get();
        return $users;
      }
}
