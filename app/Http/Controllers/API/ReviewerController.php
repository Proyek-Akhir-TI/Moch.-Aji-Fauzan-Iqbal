<?php

namespace App\Http\Controllers\API;
use App\Reviewer;
use App\Usulan;
use App\Reviewer_usulan;
use App\Reviewer_nilai;
use App\Reviewer_file;
use App\Record_status;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ReviewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Gate::allows('isUser')) {
            // $user = auth('api')->user();
            // return Usulan::select('usulan.id','c.rekomendasi','usulan.judul','usulan.deskripsi','usulan.created_at','usulan.updated_at','usulan.id_kategori','usulan.file','usulan_catatan.status','c.abstrak','c.isi','c.kesimpulan','users.name as user_upload','b.name as reviewer','status.nama_status','usulan_catatan.status_catatan','kategori.kategori')
            //     ->leftJoin('users', 'usulan.id_user', '=', 'users.id')
            //     ->leftJoin('status', 'usulan.status', '=', 'status.id')
            //     ->leftJoin('usulan_catatan', 'usulan.id', '=', 'usulan_catatan.id_usulan')
            //     ->leftJoin('kategori','usulan.id_kategori','=','kategori.id')
            //     ->leftJoin('reviewer_usulan','usulan.id','=','reviewer_usulan.id_usulan')
            //     ->leftJoin('users as b', 'reviewer_usulan.id_reviewer', '=', 'b.id')
            //     ->leftJoin('reviewer_nilai as c', function($join){
            //         $join->on('usulan.id', '=', 'c.id_usulan')
            //              ->on('c.id_reviewer', '=', 'b.id');
            //     })
            //     ->where('reviewer_usulan.id_reviewer',$user->id)
            //     ->groupBy(['reviewer_usulan.id_usulan', 'reviewer_usulan.id_reviewer'])
            //     // ->where('usulan_catatan.id_reviewer',$user->id)
            //     ->orderBy('usulan.id','DESC')
            //     ->paginate(10);
            $user = auth('api')->user();
            return DB::table('usulan as a')
            ->select('a.id','a.judul','a.deskripsi','a.file','b.id_reviewer','d.abstrak','d.isi','d.kesimpulan','c.name','e.kategori','f.status','f.status_catatan','a.id_kategori','d.rekomendasi')
                ->leftJoin('reviewer_usulan AS b', 'b.id_usulan', '=', 'a.id')
                ->leftJoin('users AS c', 'b.id_reviewer', '=', 'c.id')
                ->leftJoin('reviewer_nilai AS d', function($join){
                            $join->on('d.id_reviewer', '=', 'b.id_reviewer')
                                 ->on('d.id_usulan', '=', 'b.id_usulan');
                })
                ->leftJoin('kategori AS e', 'a.id_kategori','=','e.id')
                ->leftJoin('usulan_catatan AS f', function($join){
                    $join->on('f.id_usulan', '=', 'a.id')
                         ->on('f.id_reviewer', '=', 'b.id_reviewer');
                })
                ->where('b.id_reviewer',$user->id)
                ->orderBy('a.id','DESC')
                ->paginate(10);
           
        }
    }

    public function index_reviewer($id)
    {
        return User::where('users.type','=','2')->where('id','!=',$id)->get();
    }

    public function get_reviewer($id)
    {
        return Reviewer::getListReviewer($id);
    }

    public function get_reviewer_nilai($id)
    {
        return Reviewer::getListReviewerNilai($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reviewer = Reviewer::create([
            'status_catatan' => $request['catatan'],
            'id_usulan' => $request['id'],
        ]);

        return $reviewer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function show(Reviewer $reviewer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function edit(Reviewer $reviewer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $reviewer = Reviewer::findOrFail($id);
        $user = auth('api')->user();
        if($request->hasFile('file')){
            $fileName = Date('Y-h-d').'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('file'), $fileName);
            
            Reviewer_file::create([
                'file'=>$fileName,
                'id_usulan'=>$id,
                'id_user'=>$user->id
            ]);   
        }

        $record_status =[
            'is_active'=>0,
        ];

        DB::table('record_status')
        ->where('id_usulan', $id)
        ->update($record_status);

        $cek_status = Record_status::where('id_usulan', $id)->where('status', '5')->first();
        if($cek_status){
            $cek_status->update([
                'is_active'=>'1',
            ]);
        } else {
            Record_status::create([
                'status' => 5,
                'tanggal'=>Date('Y-h-d h:i:s'),
                'is_active'=>'1',
                'id_usulan'=>$id
            ]);
        }
        

        // $reviewer = Reviewer::where('id_reviewer','=',$user->id)->where('id_usulan','=', $id)->first();
        $reviewer_up =[
            'status'=>5,
            'status_catatan' => $request['status_catatan'],
        ];

        DB::table('usulan_catatan')
        ->where('id_reviewer', $user->id)
        ->where('id_usulan', $id)
        ->update($reviewer_up);

        $usulan = Usulan::findOrFail($id);

        $usulan->update([
            'abstrak'=>$request['abstrak'],
            'isi'=>$request['isi'],
            'kesimpulan'=>$request['kesimpulan'],
        ]);

        $reviewer_nilai = Reviewer_nilai::where('id_usulan', $id)->where('id_reviewer', $user->id)->first();
            $reviewer_nilai->update([
                'abstrak'=>$request['abstrak'],
                'isi'=>$request['isi'],
                'kesimpulan'=>$request['kesimpulan'],
                'id_reviewer'=>$user->id,
                'id_usulan'=>$id,
                'rekomendasi'=>$request['rekomendasi']
            ]);
        
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reviewer  $reviewer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reviewer = Reviewer_usulan::findOrFail($id);

        // delete the user

        $reviewer->delete();

        return $reviewer;
    }

    public function fileupload($id){
        $user = auth('api')->user();
        $file = Reviewer_file::where('id_usulan','=',$id)->where('id_user', $user->id)->get();
        return response()->json($file);
    }
    public function getfileuploadReviewer($id){
        $user = auth('api')->user();
        // $file = Reviewer_file::where('id_usulan','=',$id)->get();
        $file = DB::table('reviewer_files')
        ->select('reviewer_files.*','users.name')
        ->leftJoin('users','reviewer_files.id_user','users.id')
        ->where('id_usulan', $id)
        ->get();

        return response()->json($file);
        
    }
}
