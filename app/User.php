<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'bio', 'photo'
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

    public static function allJoin(){
        $user = auth('api')->user();
        return $user = DB::table('users')
            ->select('users.*','roles.role')
            ->leftJoin('roles', 'users.type', '=', 'roles.id')
            ->paginate(5);
    }

    public static function reviewer(){
        $user = auth('api')->user();
        return $user = DB::table('users')
            ->select('users.*','roles.role')
            ->where('users.type','=','3');
    }

}
