<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Usulan extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'usulan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul', 'deskripsi', 'file','id_user','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public static function allJoin_id(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
            ->select('usulan.*','users.name')
            ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
            ->where('usulan.id_user',$user->id)
            ->paginate(5);
    }

    public static function allJoin(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
            ->select('usulan.*','users.name')
            ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
            ->where('usulan.status','=','pengajuan')
            ->paginate(5);
    }

    public static function allJoin_diterima(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
            ->select('usulan.*','users.name')
            ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
            ->where('usulan.status','diterima')
            ->paginate(5);
    }
}
