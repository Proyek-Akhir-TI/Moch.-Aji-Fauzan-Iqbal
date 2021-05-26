<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reviewer extends Model
{
    protected $primaryKey = 'id_usulan';

    public $timestamps = false;

    protected $table = 'usulan_catatan';

    protected $fillable = [
        'status_catatan','id_usulan'
    ];

    public static function getReviewer(){
        $user = DB::table('users')
            ->select('users.*')
            ->where('users.type','=','3')
            ->get();
        return $user;
    }

    public static function allJoin_id(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','b.name as reviewer','status.nama_status','usulan_catatan.status_catatan','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('status', 'usulan.status', '=', 'status.id')
                ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                ->where('usulan.id_reviewer',$user->id)
                // ->where('usulan.status','1')
                ->paginate(10);
    }
}
