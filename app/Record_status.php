<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Record_status extends Model
{
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $table = 'record_status';

    protected $fillable = [
        'status','tanggal','is_active','id_usulan'
    ];

    public static function getReviewer(){
        $user = DB::table('users')
            ->select('users.*')
            ->where('users.type','=','2')
            ->get();
        return $user;
    }

    public static function getListReviewer($id){
        $user = DB::table('users')
            ->select('users.*','reviewer_usulan.id_usulan','reviewer_usulan.id_reviewer','reviewer_usulan.id as id_post')
            ->leftJoin('reviewer_usulan','users.id','=','reviewer_usulan.id_reviewer')
            ->where('reviewer_usulan.id_usulan',$id)
            ->get();
        return $user;
    }

    public static function getListReviewerNilai($id){
        $nilai = DB::table('reviewer_nilai')
            ->select('reviewer_nilai.*','users.name as nama_reviewer')
            ->leftJoin('users','reviewer_nilai.id_reviewer','=','users.id')
            ->where('reviewer_nilai.id_usulan',$id)
            ->get();
        return $nilai;
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
                ->paginate(10);
    }


}
