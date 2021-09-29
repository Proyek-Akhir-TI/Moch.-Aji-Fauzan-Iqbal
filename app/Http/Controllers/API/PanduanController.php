<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Panduan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PanduanController extends Controller
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
        return panduan::first();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $fileName = 'panduan '.$request->file->getClientOriginalName();
        $request->file->move(public_path('file'), $fileName);
        if(panduan::first() == null){
            panduan::create([
                'file' => $fileName,
            ]);
        }else{
            panduan::first()->update([
                'file' => $fileName,
            ]);
        }
        
        return response()->json($request);
    }

    public function downloadPanduan($file){
        $path = public_path().'/file/'.$file; // or storage_path() if needed
        $header = [
            'Content-Type' => 'application/*',
        ];
        return response()->download($path, $file, $header);
     }

     public function downloadp(){
        // $panduan = Panduan::first()->file;
        // $path = public_path().'/file/'.$panduan; // or storage_path() if needed
        // $header = [
        //     'Content-Type' => 'application/*',
        // ];
        // // return response()->download($path, $panduan, $header);
        // return Storage::download($panduan);
        echo 'muehehhe';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
