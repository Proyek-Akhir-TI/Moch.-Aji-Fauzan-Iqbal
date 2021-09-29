<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dosen extends Model
{
    protected $table = 'usulan';
    protected $fillable = [
        'judul', 'deskripsi', 'file','id_user','status','id_reviewer','id_kategori','rekomendasi'
    ];
    
    public static function getAdmin(){
        $user = DB::table('users')
            ->select('users.*')
            ->where('users.type','=','1')
            ->get();
        return $user;
    }
    public static function allJoin_id(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori','record_status.status')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                // ->whereIn('usulan.status',['2','1','5'])
                ->orderBy('usulan.id','DESC')
                ->paginate(10);
    }
    public static function allJoin_idstatus(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori','record_status.status')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                // ->where('record_status.is_active','1')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                ->where('record_status.status','!=','1')
                ->where('record_status.status','!=','2')
                ->where('record_status.status','!=','5')
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                // ->whereIn('usulan.status',['2','1','5'])
                ->orderBy('usulan.id','DESC')
                ->paginate(10);
    }

    public static function catatan($id){
        $user = auth('api')->user();
        return $catatan = DB::table('usulan_catatan')
                ->select('usulan_catatan.*','b.name as reviewer')
                ->leftJoin('users as b', 'usulan_catatan.id_reviewer', '=', 'b.id')
                ->where('usulan_catatan.id_usulan',$id)
                ->get();
    }

    public static function allJoinTanggal($tanggal){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                ->where('usulan.created_at','like','%'.$tanggal.'%')
                ->orderBy('usulan.id','DESC')
                ->paginate(100);
    }

    public static function allJoinStatus($status){
        $user = auth('api')->user();
        if($status == '0'){
            return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                ->orderBy('usulan.id','DESC')
                ->paginate(100);
        } else {
            return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                ->where('record_status.status',$status)
                ->orderBy('usulan.id','DESC')
                ->paginate(100);
        }
    }

    public static function allJoinKategori($kategori){
        $user = auth('api')->user();
        if($kategori =='0'){
            return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                ->orderBy('usulan.id','ASC')
                ->paginate(100);
        } else {
            return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                ->where('usulan.id_kategori',$kategori)
                ->orderBy('usulan.id','ASC')
                ->paginate(100);
        }
        
    }

    public static function allJoinjudul($judul){
        $user = auth('api')->user();
        if($judul){
            return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                ->where('usulan.judul','like','%'.$judul.'%')
                ->orderBy('usulan.id','ASC')
                ->paginate(100);
        } elseif(empty($judul)) {
            return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                ->where('record_status.is_active','1')
                ->where('usulan.id_user',$user->id)
                ->orderBy('usulan.id','ASC')
                ->paginate(100);
        }
        
    }

}
