<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\profile;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin')) {
        //    return User::latest()->paginate(5);
        //    return User::paginate(5);
            return User::allJoin();
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
        
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);
        

        $iduser =  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'bio' => $request['bio'],
            'password' => Hash::make($request['password']),
        ])->id;
        profile::create(["nip_nik"=>$request->nip_nik,"id_prodi"=>$request->id_prodi,"id_user"=>$iduser]);
        return "Success";
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();

        // $this->validate($request,[
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        //     'password' => 'sometimes|required|min:6'
        // ]);
        User::where('id','=',$user->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'bio'=>$request->bio,
        ]);
        profile::where('id_user','=',$user->id)
        ->update(
            [
                'id_prodi'=>$request->id_prodi,
                'nip_nik'=>$request->nip_nik,
            ]
        );
        $currentPhoto = profile::where('id_user','=',$user->id)->first()->foto_profil;
        if( $request->photo != $currentPhoto && $request->photo !="profile.png"){

            $name=time().'.'. explode('/', explode(':',substr($request->photo,0,strpos($request->photo,';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
              @unlink($userPhoto);
            }
            profile::where('id_user','=',$user->id)->update(['foto_profil'=>$name]);
          }

        // if(!empty($request->password)){
        //     $request->merge(['password' => Hash::make($request['password'])]);
        // }

        // $user->update($request->all());
        return $request;
        // return ['message' => "Success"];
    }

    public function updateProfilePassword(Request $request)
    {
        $user = auth('api')->user();
        $user->update([
            "password"=> Hash::make($request['password']),
        ]);
        return "Success";
    }


    public function updatePassword(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request,[
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => "Success"];
    }

    public function profile()
    {
        return User::join('profiles','profiles.id_user','users.id')
        ->select('users.name','users.id','users.email','users.type','users.bio',
        'profiles.foto_profil as photo','profiles.nip_nik','profiles.id_prodi')
        ->where('users.id','=',auth('api')->user()->id)->first()
        ;
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
        $user = User::findOrFail($id);
        $profile =profile::where('id_user','=',$id)->first();

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6'
        ]);

        $user->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "type"=>$request->type,
            "bio"=>$request->bio
        ]);
        $profile->update(["nip_nik"=>$request->nip_nik,"id_prodi"=>$request->id_prodi]);
        return ['message' => 'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $user = User::findOrFail($id);
        // delete the user
        profile::where('id_user','=',$id)->delete();
        $user->delete();

        return ['message' => 'User Deleted'];
    }

    public function search(){

        if($search =\Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")
                        ->orWhere('email','LIKE',"%$search%")
                        ->orWhere('type','LIKE',"%$search%");
            })->paginate(20);
        } else {
            $users = User::latest()->paginate(5);
        }

        return $users;
    }

    public function reviewer()
    {
        $reviewer = User::reviewer();
        return response()->$reviewer;
    }
}
