<?php

namespace App\Http\Controllers\API;
use App\Dosen;
use App\Reviewer;
use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        //

        $fileName = Date('Y-h-d').'-REV'.'.'.$request->file->getClientOriginalExtension();
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
        
        if($request->file){
            $fileName = time().'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('file'), $fileName);

            $dosen->update([
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                // 'file' => $request['file'],
                'file' => $fileName,
                'id_user'=> $user->id,
                'id_kategori'=>$request['id_kategori']
            ]);
        } else {
            $dosen->update([
                'judul' => $request['judul'],
                'deskripsi' => $request['deskripsi'],
                // 'file' => $request['file'],
                'id_user'=> $user->id,
                'id_reviewer'=>'0',
                'status'=>'1',
                'id_kategori'=>$request['id_kategori']
            ]);
        }

        File::create([
            'file'=>$fileName,
            'id_usulan'=>$id
        ]);

        
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

    public function fileupload($id){
        $file = File::where('id_usulan','=',$id)->get();
        return response()->json($file);
    }
}
