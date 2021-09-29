<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usulan;
use App\Reviewer;
use App\Reviewer_usulan;
use App\Reviewer_nilai;
use App\Kategori;
use App\File;
use App\User;
use App\Prodi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Mail\Email_reviewer;
use App\Mail\Email_dosen;
use App\Record_status;
// Panggil support email dari Laravel
use Illuminate\Support\Facades\Mail;

class UsulanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        //
        // if (\Gate::allows('isUser')) {
            // return Usulan::latest()->paginate(10);
            return Usulan::allJoin_id();
        //  }
    }

    public function index_admin()
    {
        //
        if (\Gate::allows('isAdmin')) {
            return Usulan::allJoin();
        }
    }

    public function index_diterima()
    {
        //
            return Usulan::allJoin_diterima();
    }

    public function index_admin_status()
    {
        //
        if (\Gate::allows('isAdmin')) {
            return Usulan::allJoinStatus_or();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $usulan = auth('api')->usulan();
        $user = auth('api')->user();
        //

        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('file'), $fileName);

        $usulan = Usulan::create([
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            // 'file' => $request['file'],
            'file' => $fileName,
            'id_user'=> $user->id,
            'id_reviewer'=>$request['id_reviewer'],
            'status'=>$request['status']
        ]);

        

        File::create([
            'file'=>$fileName,
            'id_usulan'=>$usulan->id
        ]);

        return $usulan;
    }

    public function downloadFile($file){
        $path = public_path().'/file/'.$file; // or storage_path() if needed
        $header = [
            'Content-Type' => 'application/*',
        ];
        return response()->download($path, $file, $header);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usulan = Usulan::findOrFail($id);
        $user = auth('api')->user();

        // $usulan->update($request->all());

        $usulan->update([
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            // 'file' => $request['file'],
            'status'=>$request['status']
        ]);

        $cek_status = Record_status::where('id_usulan', $id)->where('status', '2')->first();
        if($cek_status){
            $cek_status->update([
                'is_active'=>'1',
            ]);
        } else {
            Record_status::create([
                'status' => 2,
                'tanggal'=>Date('Y-h-d h:i:s'),
                'is_active'=>'1',
                'id_usulan'=>$id
            ]);
        }

        $record_status =[
            'is_active'=>0,
        ];

        DB::table('record_status')
        ->where('id_usulan', $id)
        ->update($record_status);

        if($request['status'] != '1'){
            Record_status::create([
                'status' => $request['status'],
                'tanggal'=>Date('Y-h-d h:i:s'),
                'is_active'=>'1',
                'id_usulan'=>$id
            ]);
        }

        

        
        
        if($request['id_reviewer']){
            foreach($request['id_reviewer'] as $reviewer){
                $reviewer_list = Reviewer_usulan::create([
                    'id_reviewer'=>$reviewer,
                    'id_usulan'=>$id
                ]);
                
                $getUsulanUser = Usulan::getUserUsulan($id);
                $getName = Usulan::getUserInfo($getUsulanUser[0]->id_user);
                $getReviewer = Usulan::getUserInfo($reviewer);

                $kirim = Mail::to($getReviewer[0]->email)->send(new Email_reviewer( $request['judul'],$getName[0]->name,Date('Y-h-d h:i:s')));

                $getUsulanUsers = Usulan::getUserUsulan($id);
                $getNames = Usulan::getUserInfo($getUsulanUser[0]->id_user);
                $getReviewers = Usulan::getUserInfo($getUsulanUser[0]->id_user);

                if($request['status'] == '3'){
                    echo 'tes';
                    $status = 'Diterima';
                    $emailToDosen = Mail::to($getReviewers[0]->email)->send(new Email_dosen( $request['judul'],$getNames[0]->name,$status,Date('Y-h-d h:i:s')));
                } elseif($request['status'] == '4') {
                    echo 'gagal';
                    $status = 'Ditolak';
                    $emailToDosen = Mail::to($getReviewers[0]->email)->send(new Email_dosen( $request['judul'],$getNames[0]->name,$status,Date('Y-h-d h:i:s')));
                }

                Reviewer::create([
                    'status'=>'1',
                    'id_usulan' => $request['id'],
                    'id_reviewer'=> $reviewer,
                    'status_catatan'=>null
                ]);
                Reviewer_nilai::create([
                    'abstrak'=>null,
                    'isi'=>null,
                    'kesimpulan'=>null,
                    'id_reviewer'=>$reviewer,
                    'id_usulan'=>$id,
                    'rekomendasi'=>null
                ]);
            }
        }
        
        return ['message' => 'Usulan telah diupdate'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usulan = Usulan::findOrFail($id);

        // delete the user

        $usulan->delete();

        return ['message' => 'Usulan Deleted'];
    }

    public function jumlahUsulan()
    {
        return Usulan::selectRaw("COUNT(*) data, DATE_FORMAT(created_at, ' %M') labels")
        ->groupBy('labels')
        ->orderBy('created_at','ASC')
        ->get();
    }

    public function jumlahUsulanBar()
    {
        return Kategori::leftjoin('usulan','usulan.id_kategori','=','kategori.id')
        ->select('kategori.kategori',DB::raw('count(usulan.id_kategori) as jumlahusulan'))
        ->groupBy('kategori.kategori')
        ->get();
    }

    public function jumlahUsulanPie()
    {
        return prodi::leftjoin('profiles','profiles.id_prodi','prodi.id')
        ->join('users','users.id','profiles.id_user')
        ->join('usulan','usulan.id_user','users.id')
        ->select('prodi.prodi',DB::raw('count(usulan.id_user) as jumlahusulan'))
        ->groupBy('prodi.prodi')
        ->get();
    }

    public function index_tanggal($id)
    {
        //
        if (\Gate::allows('isAdmin')) {
            return Usulan::allJoinTanggal($id);
        }
    }

    public function index_status($id)
    {
        //
        if (\Gate::allows('isAdmin')) {
            return Usulan::allJoinstatus($id);
        }
    }

    public function index_kategori($id)
    {
        //
        if (\Gate::allows('isAdmin')) {
            return Usulan::allJoinkategori($id);
        }
    }

    public function index_judul($id)
    {
        //
        if (\Gate::allows('isAdmin')) {
            return Usulan::allJoinjudul($id);
        }
    }

    public function index_range($id)
    {
        //
        if (\Gate::allows('isAdmin')) {
            return Usulan::allJoinrange($id);
        }
    }

    public function getListStatus($id){
        $user = auth('api')->user();
        // $file = Reviewer_file::where('id_usulan','=',$id)->get();
        $file = DB::table('record_status')
        ->select('record_status.*','status.nama_status')
        ->leftJoin('status','record_status.status','status.id')
        ->where('record_status.id_usulan', $id)
        ->get();

        return response()->json($file);
        
    }

}
