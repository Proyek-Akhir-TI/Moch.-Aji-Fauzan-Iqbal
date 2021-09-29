<?php

namespace App\Http\Controllers\API;
use App\Dosen;
use App\Reviewer;
use App\Record_status;
use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Mail\Email_admin;
// Panggil support email dari Laravel
use Illuminate\Support\Facades\Mail;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Dosen::allJoin_id();
    }

    public function index_status()
    {
        return Dosen::allJoin_idstatus();
    }

    public function get_catatan($id)
    {
        return Dosen::catatan($id);
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
        // $dosen = auth('api')->Dosen();
        $user = auth('api')->user();

        $getReviewer = Dosen::getAdmin();
        // dd($getReviewer);

        $nama = $getReviewer[0]->name;
        $email = $getReviewer[0]->email;
        $kirim = Mail::to($email)->send(new Email_admin( $request['judul'],$user->name,Date('Y-h-d h:i:s')));
        //

        $fileName = Date('Y-h-d').'-'.$request->file->getClientOriginalName();
        $request->file->move(public_path('file'), $fileName);

        $dosen = Dosen::create([
            'judul' => $request['judul'],
            'deskripsi' => $request['deskripsi'],
            // 'file' => $request['file'],
            'file' => $fileName,
            'id_user'=> $user->id,
            'id_reviewer'=>'0',
            'status'=>'1',
            'id_kategori'=>$request['id_kategori']
        ]);

        Record_status::create([
            'status' => '1',
            'tanggal'=>Date('Y-h-d h:i:s'),
            'is_active'=>'1',
            'id_usulan'=>$dosen->id
        ]);

        Reviewer::create([
            'id_usulan'=>$dosen->id
        ]);

        File::create([
            'file'=>$fileName,
            'id_usulan'=>$dosen->id
        ]);

        return $dosen;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function downloadFile($file){
        $path = public_path().'/file/'.$file; // or storage_path() if needed
        $header = [
            'Content-Type' => 'application/*',
        ];
        return response()->download($path, $file, $header);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = auth('api')->user();
        
        if($request->hasFile('file')){
            $fileName = time().'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('file'), $fileName);
            if($dosen->status == 4){
                $status = 2;
            }else{
                $status = $dosen->status;
            }
            File::create([
                'file'=>$fileName,
                'id_usulan'=>$id
            ]);
            $dosen->update([
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                // 'file' => $request['file'],
                'status'=>$status,
                'file' => $fileName,
                'id_user'=> $user->id,
                'id_kategori'=>$request['id_kategori'],
                'rekomendasi'=>$request['rekomendasi']
            ]);
        } else {
            $dosen->update([
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                // 'file' => $request['file'],
                'id_user'=> $user->id,
                'id_reviewer'=>'0',
                'status'=>'1',
                'id_kategori'=>$request['id_kategori'],
                'rekomendasi'=>$request['rekomendasi']
            ]);
        }

      

        
        return ['message' => 'Update berhasil'];
        
        // $dosen->update($request->all());
        // return ['message' => 'Dosen telah diupdate'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);

        // delete the user

        $dosen->delete();

        return ['message' => 'Dosen Deleted'];
    }

    public function index_tanggal($id)
    {
        //
        // if (\Gate::allows('isAdmin')) {
            return Dosen::allJoinTanggal($id);
        // }
    }

    public function index_statuses($id)
    {
        //
        // if (\Gate::allows('isAdmin')) {
            return Dosen::allJoinstatus($id);
        // }
    }

    public function index_kategori($id)
    {
        //
        // if (\Gate::allows('isAdmin')) {
            return Dosen::allJoinkategori($id);
        // }
    }

    public function index_judul($id)
    {
        //
        // if (\Gate::allows('isAdmin')) {
            return Dosen::allJoinjudul($id);
        // }
    }

    public function fileupload($id){
        $file = File::where('id_usulan','=',$id)->get();
        return response()->json($file);
    }
}
