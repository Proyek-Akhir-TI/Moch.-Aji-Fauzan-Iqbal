<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usulan;
use App\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            return Usulan::allJoin();
    }

    public function index_diterima()
    {
        //
            return Usulan::allJoin_diterima();
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

    public function downloadFilex($file){
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

        $usulan->update($request->all());
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
}
