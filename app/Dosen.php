<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dosen extends Model
{
    protected $table = 'usulan';
    protected $fillable = [
        'judul', 'deskripsi', 'file','id_user','status','id_reviewer','id_kategori'
    ];
    public static function allJoin_id(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','b.name as reviewer','status.nama_status','usulan_catatan.status_catatan')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('status', 'usulan.status', '=', 'status.id')
                ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->where('usulan.id_user',$user->id)
                ->paginate(10);
    }
}
