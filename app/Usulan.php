<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        'judul', 'deskripsi', 'file','id_user','status','id_reviewer','abstrak','isi','kesimpulan','id_kategori','rekomendasi'
    ];

    public function kriteria(){
        return $this->hasMany('App\nilaiKriteria','id_usulan'); 
    }
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
                ->select('usulan.*','users.name as user_upload','b.name as reviewer','status.nama_status','usulan_catatan.status_catatan')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('status', 'usulan.status', '=', 'status.id')
                ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->where('usulan.id_user',$user->id)
                ->orderBy('usulan.id','DESC')
                ->groupBy('usulan.id')
                ->paginate(10);
        // return $user = DB::table('usulan')
        //     ->select('usulan.*','users.name')
        //     ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
        //     ->where('usulan.id_user',$user->id)
        //     ->paginate(5);
    }

    public static function allJoin(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
                ->select('usulan.id',
                'usulan.judul',
                'usulan.deskripsi',
                'usulan.file',
                'usulan.id_user',
                'usulan.id_reviewer',
                'usulan.abstrak',
                'usulan.isi',
                'usulan.kesimpulan',
                'usulan.created_at',
                'usulan.updated_at',
                'usulan.id_kategori','users.name as user_upload','status.nama_status','kategori.kategori','record_status.status','reviewer_nilai.rekomendasi')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                ->leftJoin('reviewer_nilai','usulan.id','reviewer_nilai.id_usulan')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                ->where('record_status.is_active','1')
                ->where('record_status.status','!=','3')
                ->where('record_status.status','!=','4')
                // ->where('reviewer_nilai.rekomendasi','diterima')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                // ->whereIn('usulan.status',['2','1','5'])
                ->orderBy('usulan.id','DESC')
                ->groupBy('reviewer_nilai.id_usulan')
                ->paginate(10);
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
                ->where('usulan.created_at','like','%'.$tanggal.'%')
                ->orderBy('usulan.id','DESC')
                ->paginate(100);
    }

    public static function allJoinStatus_or(){
        $user = auth('api')->user();
            return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','status.nama_status','kategori.kategori')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('record_status', 'usulan.id', '=', 'record_status.id_usulan')
                ->leftJoin('status', 'record_status.status', '=', 'status.id')
                // ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                // ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
                ->where('record_status.status','!=','1')
                ->where('record_status.status','!=','2')
                ->where('record_status.status','!=','5')
                // ->where('usulan_catatan.id_reviewer','<>', 0)
                ->where('record_status.is_active','1')
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
                ->orderBy('usulan.id','ASC')
                ->paginate(100);
        }
        
    }

    public static function allJoinrange($range){
        $user = auth('api')->user();
        if($range == 'minggu'){
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
                ->whereBetween('usulan.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->orderBy('usulan.id','ASC')
                ->paginate(100);
        } elseif($range == 'bulan'){
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
                ->where('usulan.created_at','>=', Carbon::now()->subMonth())
                ->orderBy('usulan.id','ASC')
                ->paginate(100);
        } elseif($range == 'tahun'){
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
                    ->where('usulan.created_at','>=', Carbon::now()->year)
                    ->orderBy('usulan.id','ASC')
                    ->paginate(100);
        } elseif(empty($range)) {
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
                ->orderBy('usulan.id','ASC')
                ->paginate(100);
        }
        
    }

    public static function allJoin_diterima(){
        $user = auth('api')->user();
        return $user = DB::table('usulan')
                ->select('usulan.*','users.name as user_upload','b.name as reviewer','status.nama_status','usulan_catatan.status_catatan')
                ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
                ->leftJoin('status', 'usulan.status', '=', 'status.id')
                ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
                ->leftJoin('users as b','usulan.id_reviewer','=','b.id')
                ->whereIn('usulan.status',['3','4'])
                ->orderBy('usulan.id','DESC')
                ->groupBy('usulan.id')
                ->paginate(10);
    }

    public static function getUserInfo($id){
        $user = DB::table('users')
            ->select('users.*')
            ->where('users.id','=',$id)
            ->get();
        return $user;
    }

    public static function getUserUsulan($id){
        $usulan = DB::table('usulan')
            ->select('usulan.*')
            ->where('usulan.id','=',$id)
            ->get();
        return $usulan;
    }
}
